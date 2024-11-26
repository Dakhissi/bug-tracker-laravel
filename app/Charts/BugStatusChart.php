<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class BugStatusChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        // Add chart labels and datasets
        $this->labels(['Open', 'Resolved', 'Closed']);
        $this->dataset('Bugs', 'pie', [
            \App\Models\Bug::where('status', 'Open')->count(),
            \App\Models\Bug::where('status', 'Resolved')->count(),
            \App\Models\Bug::where('status', 'Closed')->count(),
        ])->backgroundColor(['#FF6384', '#36A2EB', '#FFCE56']);
    }
    
}
