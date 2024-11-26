<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bug;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI;

class BugsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return List of bugs
     */
    public function index(Request $request)
    {
        //by default return all bugs
        // filter by status // filter by priority // filter by project // filter by assignee // filter by reporter // filter by created date
        $query = $request->get('query', '');
        $filter = $request->get('filter', '');
        $users = User::all();
        $bugs = Bug::query();
        if ($query) {
            $bugs->where('title', 'like', '%' . $query . '%');
        }
        if ($filter) {
            $bugs->where('status', $filter);
        }
        $bugs = $bugs->paginate(10);
        return view('bugs.index', [
            'bugs' => $bugs,
            'query' => $query,
            'filter' => $filter,
            'users' => $users,
        ]);

    }


    /**
     * Show the form for creating a new resource.
     * @return Create bug form
     */
    public function create()
    {
        // get all projects
        $projects = Project::all();
        return view('bugs.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return Redirect to bugs list
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'project_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'steps_to_reproduce' => 'required|string',
                'context' => 'required|string',
                'environments' => 'nullable|array',
                'attachments' => 'nullable|array',
                'solution' => 'nullable|string',
                'branch' => 'nullable|string',
                'status' => 'required|string',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'priority' => 'nullable|string',
            ]);
    
            // Automatically set reporter fields
            $validated['reporter_by'] = auth()->id(); // Set the current user's ID
            $validated['reporter_at'] = now(); // Set the current timestamp
    
            if ($request->hasFile('attachments')) {
                $validated['attachments'] = array_map(function ($file) {
                    return $file->store('attachments', 'public');
                }, $request->file('attachments'));
            }
            $bug = Bug::create($validated);
            // trigger toast
            flash()->success(__('bugs.bug_created'));
            return redirect()->route('bugs');
        } catch (\Exception $e) {
            flash()->error(__('error message : '.$e->getMessage()));
            flash()->error(__('bugs.bug_create_failed'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\Bug  $bug
     * @return Bug details
     */
    public function show(Bug $bug)
    {
        if(!$bug) {
            abort(404);
        }
        return view('bugs.show', compact('bug'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Bug  $bug
     * @return Edit bug form
     */
    public function edit(Bug $bug)
    {
        // all projects
        $projects = Project::all();
        return view('bugs.edit', compact('bug', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bug  $bug
     * @return Redirect to bugs list
     */
    public function update(Request $request, Bug $bug)
    {
        try {
            $validated = $request->validate([
                'project_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'steps_to_reproduce' => 'required|string',
                'context' => 'required|string',
                'environments' => 'nullable|array',
                'attachments' => 'nullable|array',
                'solution' => 'nullable|string',
                'branch' => 'nullable|string',
                'status' => 'required|string',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'priority' => 'nullable|string',
            ]);
            $bug->update($validated);
            flash()->success(__('bugs.bug_updated'));
            return redirect()->route('bugs');
        } catch (\Exception $e) {
            flash()->error(__('error message : ' . $e->getMessage()));
            flash()->error(__('bugs.bug_update_failed'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Bug  $bug
     * @return Redirect to bugs list
     */
    public function destroy(Bug $bug)
    {
        try {
            $bug->delete();
            return redirect()->route('bugs')->with('success', 'Bug deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the bug');
        }
    }

    /**
         * Assign the bug to a user.
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Bug $bug
         * @return \Illuminate\Http\RedirectResponse
         */
        public function assign(Request $request, Bug $bug)
        {
            $validated = $request->validate([
                'assigned_to' => 'required|integer|exists:users,id',
            ]);

            try {
                $bug->update([
                    'assigned_to' => $validated['assigned_to'],
                    'assigned_at' => now(),
                ]);
                flash()->success(__('bugs.assigned_successfully'));
                return redirect()->route('bugs');
            } catch (\Exception $e) {
                flash()->error(__('error message : ' . $e->getMessage()));
                flash()->error(__('bugs.assign_failed'));
                return redirect()->back();
            }
        }

        /**
         * Mark the bug as solved.
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Bug $bug
         * @return \Illuminate\Http\RedirectResponse
         */
        public function solve(Request $request, Bug $bug)
        {
            try {
                $validated = $request->validate([
                    'solution' => 'required|string',
                ]);
                $bug->update([
                    'status' => 'resolved',
                    'solution' => $validated['solution'],
                    'resolved_at' => now(),
                ]);
                flash()->success(__('bugs.bug_resolved'));
                return redirect()->route('bugs');
            } catch (\Exception $e) {
                flash()->error(__('error message : ' . $e->getMessage()));
                flash()->error(__('bugs.bug_resolved_failed'));
                return redirect()->back();
            }
        }

        /**
         * Close the bug.
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Bug $bug
         * @return \Illuminate\Http\RedirectResponse
         */
        public function close(Request $request, Bug $bug)
        {
            try {
                $bug->update([
                    'status' => 'closed',
                ]);
                flash()->success(__('bugs.closed_successfully'));
                return redirect()->route('bugs');

            } catch (\Exception $e) {
                flash()->error(__('error message : ' . $e->getMessage()));
                flash()->error(__('bugs.close_failed'));
                return redirect()->back()->with('error', __('bugs.close_failed') . ': ' . $e->getMessage());
            }
        }

        /**
         * Reopen the bug.
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Bug $bug
         * @return \Illuminate\Http\RedirectResponse
         */
        public function reopen(Request $request, Bug $bug)
        {
            try {
                $bug->update([
                    'status' => 'open',
                ]);
                flash()->success(__('bugs.reopened_successfully'));
                return redirect()->route('bugs');
            } catch (\Exception $e) {
                flash()->error(__('error message : ' . $e->getMessage()));
                return redirect()->back()->with('error', __('bugs.reopen_failed') . ': ' . $e->getMessage());
            }
        }


        public function aiDiagnostic(Request $request)
            {
                $request->validate([
                    'message' => 'required|string',
                    'bug_id' => 'required|integer|exists:bugs,id',
                ]);

                $userMessage = $request->input('message');
                $bugId = $request->input('bug_id');
                $bug = Bug::find($bugId);


                $apiKey = config('services.openai.key'); //load
                $client = OpenAI::client($apiKey);

                $messages = [
                    ['role' => 'system', 'content' => 'You are an AI diagnostic tool helping to solve software bugs.'],
                    ['role' => 'system', 'content' => 'The bug data are : ' . json_encode($bug)],
                    ['role' => 'user', 'content' => $userMessage],
                ];

                try {
                    Log::info('Sending request to OpenAI API', ['messages' => $messages]);
                    $response = $client->chat()->create([
                        'model' => 'gpt-4o-mini', 
                        'messages' => $messages,
                    ]);

                    Log::info('Received response from OpenAI API', ['response' => $response]);

                    $reply = $response['choices'][0]['message']['content'];

                    return response()->json(['reply' => $reply]);
                } catch (\Exception $e) {
                   flash()->error(__('error message : ' . $e->getMessage()));
                    return response()->json(['reply' => __('An error occurred while processing your request.')], 500);
                }
            }

            /**
             * count total bugs
             * @return \Illuminate\Http\JsonResponse
             * @throws \Exception
             */
            public function countBugs()
            {
                try {
                    $totalBugs = Bug::count();
                    return response()->json(['total_bugs' => $totalBugs]);
                } catch (\Exception $e) {
                    return response()->json(['error' => $e->getMessage()], 500);
                }
            }

            /**
             * count user bugs either reported or assigned
             * @return \Illuminate\Http\JsonResponse
             * @throws \Exception
             */
            public function countUserBugs()
            {
                try {
                    $userBugs = Bug::where('reporter_by', auth()->id())
                        ->orWhere('assigned_to', auth()->id())
                        ->count();
                    return response()->json(['user_bugs' => $userBugs]);
                } catch (\Exception $e) {
                    return response()->json(['error' => $e->getMessage()], 500);
                }
            }

            




}
