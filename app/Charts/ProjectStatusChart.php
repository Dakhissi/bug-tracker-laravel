<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class ProjectStatusChart extends Chart

{
    public function __construct()
    {
        parent::__construct();

                // Mock data for Project Status
                $this->labels(['Pending', 'In Progress', 'Completed']);
                $this->dataset('Projects', 'bar', [5, 10, 7]) // Mock values: 5 Pending, 10 In Progress, 7 Completed
                     ->backgroundColor(['#FF6384', '#36A2EB', '#FFCE56']);

        // $this->labels(['Pending', 'In Progress', 'Completed']);
        // $this->dataset('Projects', 'bar', [
        //     \App\Models\Project::where('status', 'Pending')->count(),
        //     \App\Models\Project::where('status', 'In Progress')->count(),
        //     \App\Models\Project::where('status', 'Completed')->count(),
        // ])->backgroundColor(['#FF6384', '#36A2EB', '#FFCE56']);
    }
}
