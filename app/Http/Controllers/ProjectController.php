<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return List of projects
     */
    public function index(Request $request)
    {
        $query = $request->get('query', '');
        $filter = $request->get('filter', '');
    
        $projects = Project::query();
        $users = User::all();

    
        if ($query) {
            $projects->where('name', 'like', '%' . $query . '%');
        }
    
        if ($filter) {
            $projects->where('status', $filter);
        }
    
        $projects = $projects->paginate(10);
    
        return view('projects.index', [
            'projects' => $projects,
            'query' => $query,
            'filter' => $filter,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Create project form
     */
    public function create()
    {
        $users = User::all();
        $projects = Project::all();
        return view('projects.create', compact('users', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return Redirect to projects list
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'stack_technologies' => 'nullable|string',
                'environments' => 'nullable|array',
                'deadline' => 'nullable|date',
                'priority' => 'nullable|string',
                'repository_url' => 'nullable|url',
                'start_date' => 'nullable|date',
            ]);
            if (strtotime($request->start_date) > strtotime($request->deadline)) {
                flash()->warning(__('projects.start_date_must_be_before_deadline'));
            }
        
    
            $validated['created_by'] = auth()->id();
            Project::create($validated);
    
            flash()->success(__('projects.created_successfully'));
            return redirect()->route('projects');
        } catch (\Exception $e) {
            flash()->error(__('projects.failed_to_create'));
            return back()
            ->withInput() ;
            
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project)
    {
        try{
                    // Validate the incoming request data
                $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'stack_technologies' => 'nullable|string',
                    'environments' => 'nullable|array',
                    'status' => 'nullable|string',
                    'deadline' => 'nullable|date',
                    'priority' => 'nullable|string',
                    'repository_url' => 'nullable|url',
                    'documentation_url' => 'nullable|url',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|date|after_or_equal:start_date',
                ]);

                // Update the project using only fillable attributes
                $data = $request->only($project->getFillable());
                $project->update($data);

                //trigger a toast
                flash()->success(__('projects.project_updated_successfully'));
                return redirect()->route('projects');
        } catch (\Exception $e) {
            flash()->error(__('error message : ' . $e->getMessage()));
            flash()->error(__('projects.failed_to_update_project'));
            return back()->withInput() ;
        }
    }

        /**
     * Add team members to a project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addTeam(Request $request, Project $project)
    {
        $request->validate([
            'team_members' => 'required|array',
            'team_members.*' => 'exists:users,id',
        ]);

        $currentMembers = $project->team_members ?? [];
        $newMembers = array_unique(array_merge($currentMembers, $request->input('team_members')));

        $project->update(['team_members' => $newMembers]);

        return redirect()->back()->with('success', 'Team members added successfully.');
    }

    /**
     * Remove team members from a project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeTeam(Request $request, Project $project)
    {
        $request->validate([
            'team_members' => 'required|array',
            'team_members.*' => 'exists:users,id',
        ]);

        $currentMembers = $project->team_members ?? [];
        $remainingMembers = array_diff($currentMembers, $request->input('team_members'));

        $project->update(['team_members' => array_values($remainingMembers)]);

        return redirect()->back()->with('success', 'Team members removed successfully.');
    }

    public function destroy(Project $project)
    {
        try {
        $project->delete();
        flash()->success(__('projects.project_deleted_successfully'));
        return redirect()->route('projects');
        } catch (\Exception $e) {
            flash()->error(__('projects.failed_to_delete_project'));
            return redirect()->route('projects');
        }
    }

    public function show(Project $project)
    {
        // if project isnt found, return 404
        if (!$project) {
            abort(404);
        }
        return view('projects.show', compact('project'));
    }

    /**
     * count all projects
     * @return int
     * @exception \Exception
     */
    public function countProjects()
    {
        try {
            return Project::count();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * count projects where the user is a team member
     * @param User $user
     * @return int
     * @exception \Exception
     */
    public function countProjectsByUser(User $user)
    {
        try {
            return Project::where('team_members', 'like', '%'.$user->id.'%')->count();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }



}
