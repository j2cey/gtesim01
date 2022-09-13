<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Status;
use Khill\Lavacharts\Lavacharts;
use App\Traits\Charts\EsimCharts;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use EsimCharts;

    public function vuechart() {
        $chartData = json_encode( (object) $this->chartdatastruct() );
        //dd($chartData);
        return view('dashboards.vuechart')
            ->with('chartData', $chartData);
    }

    public function chartdatamonth($month) {
        $esims_stats_resume = $this->getEsimsStatsResume();
        $esims_stats_month = $this->getEsimsStatsMonth(7);
        return $esims_stats_month['chartjsdata'];
    }

    private function chartdatastruct() {
        $cdata = ['labels' => ['January','February','March','April','May','June','July'],
          'datasets'=> [
            [
              'label' => "Data One",
              'borderColor' => "#4bcc96",
              'borderWith' => 4,
              'pointBackgroundColor' => "#000",
              'fill' => false,
              'data' => [15, 39, 20, 40, 39, 80, 40]
            ]
          ]
        ];
        return $cdata;
    }

    public function index() {
        return view('dashboards.esims');
    }

    public function fetchrawstats() {
        $esims_stats_resume = $this->getEsimsStatsResume();
        return $esims_stats_resume;
    }

    public function fetchmonthsofyear() {
        $monthsofyear = [
            ['label'=> "Janvier", 'value' => 1],
            ['label'=> "Fevrier", 'value' => 2],
            ['label'=> "Mars", 'value' => 3],
            ['label'=> "Avril", 'value' => 4],
            ['label'=> "Mai", 'value' => 5],
            ['label'=> "Juin", 'value' => 6],
            ['label'=> "Juillet", 'value' => 7],
            ['label'=> "Aout", 'value' => 8],
            ['label'=> "Septembre", 'value' => 9],
            ['label'=> "Octobre", 'value' => 10],
            ['label'=> "Novembre", 'value' => 11],
            ['label'=> "Décembre", 'value' => 12],
        ];
        return $monthsofyear;
    }

    public function fetchcurrentmonth() {
        $monthindex = date('m') - 1 ;
        $monthsofyear = $this->fetchmonthsofyear();
        $currentmonth = $monthsofyear[$monthindex];

        return $currentmonth;
    }

    public function fetchweeksofyear() {
        $weeksofyear = [];
        for ($i = 1; $i < 53; $i++) {
            $weeksofyear[] = ['label'=> "Semaine " . $i, 'value' => $i];
        }
        return $weeksofyear;
    }

    public function fetchcurrentweek() {
        $weekindex = date('W') - 1 ;
        $weeksofyear = $this->fetchweeksofyear();
        $currentweek = $weeksofyear[$weekindex];

        return $currentweek;
    }

    public function fetchmonthstats($month) {
        $esims_stats_month = $this->getEsimsStatsMonth($month);
        return $esims_stats_month;
    }

    public function fetchweekstats($week) {
        $esims_stats_week = $this->getEsimsStatsWeek($week);
        return $esims_stats_week;
    }

    public function fetchyears() {
        $years = [
            ['label'=> "2022", 'value' => 2022],
            ['label'=> "2023", 'value' => 2023],
            ['label'=> "2024", 'value' => 2024],
        ];
        return $years;
    }

    public function fetchcurrentyear() {
        $year = date('Y') ;

        return ['label'=> $year, 'value' => $year];
    }

    public function fetchyearstats($year) {
        $esims_stats_year = $this->getEsimsStatsYear($year);
        return $esims_stats_year;
    }
}
