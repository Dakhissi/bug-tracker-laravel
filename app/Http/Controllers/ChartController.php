<?php
namespace App\Http\Controllers;

use App\Charts\ProjectStatusChart;
use App\Charts\BugStatusChart;
use App\Models\Bug;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function index(ProjectStatusChart $projectStatusChart, BugStatusChart $bugStatusChart)
    {
        // count all projects 
        $totalProjects = Project::count();
        $totalBugs = Bug::count();
        // count all projects where the user ispart of team memebers array 
        $totalUserProjects = Project::whereJsonContains('team_members', auth()->id())->count();


        // count all bugs where the user is the reporter or assigned to
        $totalUserBugs = Bug::where('reporter_by', auth()->id())
            ->orWhere('assigned_to', auth()->id())
            ->count();

        $projectStatusChart = new ProjectStatusChart;
        $bugStatusChart = new BugStatusChart;

        return view('dashboard.index', compact('projectStatusChart', 'bugStatusChart', 'totalProjects', 'totalBugs', 'totalUserProjects', 'totalUserBugs'));
    }
}
