<?php

namespace App\Traits\Charts;

use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Esims\Esim;
use App\Models\Esims\StatutEsim;
use App\Models\Esims\ClientEsim;

trait EsimCharts
{
    use Charts, ChartjsData;

    public function getEsimsStatsYear($year) {
        $year_period = $this->getYearPeriod($year);
        return $this->getEsimsStatsPeriod($year_period);
    }

    public function getEsimsStatsMonth($month) {
        $month_period = $this->getMonthPeriod($month);
        return $this->getEsimsStatsPeriod($month_period);
    }

    public function getEsimsStatsWeek($week) {
        $week_period = $this->getWeekPeriod($week);
        return $this->getEsimsStatsPeriod($week_period);
    }

    public function getEsimsStatsPeriod($period) {
        $esimsattribuees = $this->getStatsRaw($period);

        // les agences actives de la période (les courbes)
        $agences_actives = [];

        foreach ($esimsattribuees['data'] as $esim) {
            if ($esim->phonenum && $esim->phonenum->creator && $esim->phonenum->creator->employe) {
                $creator = $esim->phonenum->creator;
                $agences_actives = $this->addLabel($esimsattribuees['data']->count(),$agences_actives,$creator->employe->departement->id,$creator->employe->departement->intitule);
            } else {
                $agences_actives = $this->addLabel($esimsattribuees['data']->count(),$agences_actives,0,$this->getIndefinedLabelLabel());
            }
        }

        $agences_actives_colors_hex = [];

        foreach ($agences_actives as $agence) {
            $agences_actives_colors_hex[] = $agence['color']['hex'];
        }

        // remplissage des valeurs (les y)
        $valeurs_distribuees = $this->getDistributedValues($esimsattribuees['data'],$agences_actives,$period['xvalues'],$period['xref']);

        return [
            'agences' => $agences_actives,
            'agence_first' => $this->getLabelIndexByOrd($agences_actives, 1, true),
            'agence_second' => $this->getLabelIndexByOrd($agences_actives, 2, true),
            'agence_third' => $this->getLabelIndexByOrd($agences_actives, 3, true),
            'agences_colors_hex' => $agences_actives_colors_hex,
            'xvalues' => $period['xvalues'],
            'values_by_xvalue' => $valeurs_distribuees['by_xvalue'],
            'values_by_agence' => $valeurs_distribuees['by_agence'],
            'count' => $esimsattribuees['data']->count(),
            'chartjsdata' => $this->getChartData($period['xvalues'],$agences_actives,$valeurs_distribuees['by_agence'])
        ];
    }
    public function getWeekPeriod($weeknumber) {
        $week_start = (new \DateTime())->setISODate(date("Y"),$weeknumber)->format("Y-m-d H:i:s");

        $start_ofWeek = Carbon::createFromFormat("Y-m-d H:i:s", $week_start);
        $start_ofWeek->hour(0)->minute(0)->second(0);
        $end_ofWeek = $start_ofWeek->copy()->endOfWeek();

        // xvalues de la période les x
        $xvalues = [];
        for ($i = $start_ofWeek->day; $i <= $end_ofWeek->day; $i++) {
            $xvalues[] = $i;
        }

        return [
            'xref' => "day",
            'xvalues' => $xvalues,
            'start' => $start_ofWeek,
            'end' => $end_ofWeek
        ];
    }

    private function getMonthPeriod($month) {
        $year = Carbon::now()->year;
        $date_str = "first day of " . $this->getMonthName($month) . " " . $year;
        $start_ofMonth = new Carbon($date_str);
        $end_ofMonth = (new Carbon($date_str))->endOfMonth();

        // xvalues de la période les x
        $xvalues = [];

        for ($i = $start_ofMonth->day; $i <= $end_ofMonth->day; $i++) {
            $xvalues[] = $i;
        }

        return [
            'xref' => "day",
            'xvalues' => $xvalues,
            'start' => $start_ofMonth,
            'end' => $end_ofMonth,
        ];
    }

    public function getYearPeriod($year) {

        $date_str = "first day of january " . $year;
        $start_ofYear = new Carbon($date_str);
        $date_str = "first day of december " . $year;
        $end_ofYear = (new Carbon($date_str))->endOfMonth();

        // mois de la période les x
        $xvalues = [];

        for ($i = $start_ofYear->month; $i <= $end_ofYear->month; $i++) {
            $xvalues[] = $i;
        }

        return [
            'xref' => "month",
            'xvalues' => $xvalues,
            'start' => $start_ofYear,
            'end' => $end_ofYear,
        ];
    }

  public function getStatsRaw($period) {
    $statutesim_attribue = StatutEsim::attribue()->first();

    $period_start = $period['start'];
    $period_end = $period['end'];

    // toutes les sims attribuées durant ce mois
    $esimsattribuees_req = Esim::with(['phonenum','phonenum.creator','phonenum.creator.employe.departement'])
        ->whereHas('statutesim', function ($query) use ($statutesim_attribue) {
            $query->where( 'id', $statutesim_attribue->id );
        })
        ->whereHas('phonenum', function ($query) use ($period_start,$period_end) {
            $query->whereBetween('created_at', [$period_start,$period_end]);
        });

    return [
      'period_start' => $period_start,
      'period_end' => $period_end,
      'data' => $esimsattribuees_req->get()
    ];
  }

  private function getDistributedValues($esims, $agences, $xvalues, $xref) {
    $distributed_values_byxvalue = [];
    $distributed_values_byagence = [];

    // init by x values
    foreach ($xvalues as $xvalue) {
        $init_day = [];
        foreach ($agences as $key => $agence) {
            $init_day[$key] = 0;
        }
        $distributed_values_byxvalue[$xvalue] = $init_day;
    }
    // init by agence
    foreach ($agences as $key => $agagence) {
        $init_agence = [];
        foreach ($xvalues as $xvalue) {
            $init_agence[$xvalue] = 0;
        }
        $distributed_values_byagence[$key] = $init_agence;
    }

    foreach ($esims as $index => $esim) {
        $esim_xvalue = Carbon::parse($esim->phonenum->created_at)->{$xref};

        if ( $esim->phonenum->creator ) {
            $agence_idx = $esim->phonenum->creator->employe->departement->intitule;
            $distributed_values_byxvalue[$esim_xvalue][$agence_idx]++;
            $distributed_values_byagence[$esim->phonenum->creator->employe->departement->intitule][$esim_xvalue]++;
        } else {
          $agence_idx = $this->getIndefinedLabelLabel();
          $distributed_values_byxvalue[$esim_xvalue][$agence_idx]++;
          $distributed_values_byagence[$agences[$agence_idx]['label']][$esim_xvalue]++;
        }
    }
    return [
        'by_xvalue' => $distributed_values_byxvalue,
        'by_agence' => $distributed_values_byagence,
    ];
  }

  public function getEsimsStatsResume() {

      $status_active = Status::active()->first();

      $statutesim_libre = StatutEsim::nouveau()->first();
      $statutesim_attribue = StatutEsim::attribue()->first();

      $usersactive = User::whereHas('status', function ($query) use ($status_active) {
          $query->where( 'id', $status_active->id );
      })->get();

      $clientsesim = ClientEsim::with(['creator','creator.employe.departement'])->get();

      $esimslibres = Esim::whereHas('statutesim', function ($query) use ($statutesim_libre) {
            $query->where( 'id', $statutesim_libre->id );
      })->get();

      $esimsattribuees_req = Esim::with(['phonenum','phonenum.creator','phonenum.creator.employe.departement'])
            ->whereHas('statutesim', function ($query) use ($statutesim_attribue) {
            $query->where( 'id', $statutesim_attribue->id );
            })
            ->whereHas('phonenum');
      $esimsattribuees = $esimsattribuees_req->get();

      return [
          'activesusers' => $usersactive->count(),
          'clientsesim' => $clientsesim->count(),
          'libres' => $esimslibres->count(),
          'attribuees' => $esimsattribuees->count(),
      ];
  }
}
