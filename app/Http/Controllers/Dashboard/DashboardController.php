<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Status;
use App\Models\Esims\Esim;
use App\Models\Esims\StatutEsim;
use App\Models\Esims\ClientEsim;
use Khill\Lavacharts\Lavacharts;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {

        $statutesim_libre = StatutEsim::nouveau()->first();
        $statutesim_attribue = StatutEsim::attribue()->first();

        $esimslibres = Esim::whereHas('statutesim', function ($query) use ($statutesim_libre) {
            $query->where( 'id', $statutesim_libre->id );
        })->get();

        $esimsattribuees_req = Esim::with(['phonenum','phonenum.creator','phonenum.creator.employe.departement'])
            ->whereHas('statutesim', function ($query) use ($statutesim_attribue) {
            $query->where( 'id', $statutesim_attribue->id );
            })
            ->whereHas('phonenum');
        $esimsattribuees = $esimsattribuees_req->get();

        $esimsattribuees_sans_phonenum = Esim::with(['phonenum','phonenum.creator','phonenum.creator.employe.departement'])->whereHas('statutesim', function ($query) use ($statutesim_attribue) {
            $query->where( 'id', $statutesim_attribue->id );
        })
            ->whereDoesntHave('phonenum')
            ->get();

        //dd($esimsattribuees_sans_phonenum);

        $clientsesim = ClientEsim::with(['creator','creator.employe.departement'])->get();

        $status_active = Status::active()->first();
        $usersactive = User::whereHas('status', function ($query) use ($status_active) {
            $query->where( 'id', $status_active->id );
        })->get();

        $esims_of_month = $this->getMonthStats(7);

        //dd($esims_of_month);

        $lava = new Lavacharts();

        $esimsTable = $lava->DataTable();

        /*
        $esimsTable->addStringColumn('Agences');
        foreach ($esims_of_month['jours'] as $jour) {
            $esimsTable->addNumberColumn($jour);
        }

        foreach ($esims_of_month['values_by_agence'] as $agence => $value) {
            $rowData = array_merge([$agence],$value);
            //dump($rowData);
            try {
                $esimsTable->addRow($rowData);
            } catch (\Exception $e) {
                dd($esimsTable,$e);
            }
        }
        */

        /*
        $esimsTable->addDateColumn('Day of Month')
            ->addNumberColumn('Projected')
            ->addNumberColumn('Official');
        */

        $esimsTable->addDateColumn('Day of Month');
        foreach ($esims_of_month['agences'] as $agence) {
            $esimsTable->addNumberColumn($agence['label']);
        }

        foreach ($esims_of_month['values_by_day'] as $day => $value) {
            //$value_date = Carbon::createFromFormat('Y-m-d',$day);
            $rowData = array_merge([$day],$value);
            //dump($rowData);
            try {
                $esimsTable->addRow($rowData);
            } catch (\Exception $e) {
                dd($esimsTable,$e);
            }
        }


        // Random Data For Example
        /*
        for ($a = 1; $a < 30; $a++) {
            $rowData = [
                "2017-4-$a", rand(800,1000), rand(800,1000)
            ];
            dd($rowData);
            $esimsTable->addRow($rowData);
        }*/

        $lava->LineChart('Stocks', $esimsTable, [
            'title' => 'Stock Market Trends',
            'animation' => [
                'startup' => true,
                'easing' => 'inAndOut'
            ],
            'legend' => ['position' => 'top'],
            'colors' => $esims_of_month['agences_colors_hex']
        ]);

        /*
        $lava->ColumnChart('Simulacros', $materias, [
            'titleTextStyle' => ['color' => '#6f6ae1', 'fontSize' => 50],
            'legend' => ['position' => 'none'],
            'colors' => ['#49ABAA', '#A8A913', '#DAA10E'],
            'datatable' => $materias,
            'barGroupWidth' => 5,
            'width' => 490,
            'height' => 330,
            'isStacked' => false,
            'vAxis' => ['format' => 'decimal', 'minValue' => 0, 'maxValue' => 100, 'gridlines' => ['count' => 6]],
            'hAxis' => ['format' => 'decimal']
        ]);
        */

        //dd($esimsattribuees[80]);

        $agences_actives = [];
        /*foreach ($clientsesim as $client) {
            if ($client->creator && $client->creator->employe) {
                $agences_actives = $this->addAgence($esimsattribuees->count(),$agences_actives,$client->creator->employe->departement->id,$client->creator->employe->departement->intitule);
            }
        }*/
        foreach ($esimsattribuees as $esim) {
            if ($esim->phonenum && $esim->phonenum->creator && $esim->phonenum->creator->employe) {
                $creator = $esim->phonenum->creator;
                $agences_actives = $this->addAgence($esimsattribuees->count(),$agences_actives,$creator->employe->departement->id,$creator->employe->departement->intitule);
            }
        }

        return view('dashboards.index')
            ->with('esimslibres', $esimslibres)
            ->with('esimsattribuees', $esimsattribuees)
            ->with('clientsesim', $clientsesim)
            ->with('usersactive', $usersactive)
            ->with('clientsesimTable', $esimsTable)
            ->with('lava', $lava)
            ->with('agencesactives_m', $esims_of_month['agences'])
            ->with('esimsaffectees_m_count', $esims_of_month['count']);
    }

    private function getMonthStats($month) {

        $statutesim_attribue = StatutEsim::attribue()->first();

        $year = Carbon::now()->year;
        $date_str = "first day of " . $this->getMonthName($month) . " " . $year;
        $start_ofMonth = new Carbon($date_str);//Carbon::createFromFormat('Y-m-d', Carbon::now()->year . '-' . $month .'-'. '1');
        $end_ofMonth = (new Carbon($date_str))->endOfMonth();

        //dd($date_str,$start_ofMonth,$end_ofMonth);

        // toutes les sims attribuées durant ce mois
        $esimsattribuees_req = Esim::with(['phonenum','phonenum.creator','phonenum.creator.employe.departement'])
            ->whereHas('statutesim', function ($query) use ($statutesim_attribue) {
                $query->where( 'id', $statutesim_attribue->id );
            })
            ->whereHas('phonenum', function ($query) use ($start_ofMonth,$end_ofMonth) {
                $query->whereBetween('created_at', [$start_ofMonth,$end_ofMonth]);
            });
        $esimsattribuees = $esimsattribuees_req->get();

        // les agences actives du mois (les courbes)
        $agences_actives = [
            //['value' => 0, 'label' => "Indéfinie", "count" => 0, "rate" => 0]
        ];

        foreach ($esimsattribuees as $esim) {
            if ($esim->phonenum && $esim->phonenum->creator && $esim->phonenum->creator->employe) {
                $creator = $esim->phonenum->creator;
                $agences_actives = $this->addAgence($esimsattribuees->count(),$agences_actives,$creator->employe->departement->id,$creator->employe->departement->intitule);
            } else {
                $agences_actives = $this->addAgence($esimsattribuees->count(),$agences_actives,0,"Indéfinie");
            }
        }

        $agences_actives_colors_hex = [];
        foreach ($agences_actives as $agence) {
            $agences_actives_colors_hex[] = $agence['color']['hex'];
        }

        // jours du mois les x
        $jours_duMois = [];
        for ($i = 1; $i <= $end_ofMonth->day; $i++) {
            $jours_duMois[] = $i;
        }

        //dd($esimsattribuees,$agences_actives,$jours_duMois);

        // remplissage des valeurs (les y)
        $valeurs_distribuees = $this->distributeValues($esimsattribuees,$agences_actives,$jours_duMois,$month,$year);

        return [
            'agences' => $agences_actives,
            'agences_colors_hex' => $agences_actives_colors_hex,
            'jours' => $jours_duMois,
            'values_by_day' => $valeurs_distribuees['by_day'],
            'values_by_agence' => $valeurs_distribuees['by_agence'],
            'count' => $esimsattribuees->count(),
        ];
    }

    private function getMonthName($monthNum) {
        $month_arr = [
            '1' => "January",
            '2' => "Fabruary",
            '3' => "March",
            '4' => "April",
            '5' => "May",
            '6' => "June",
            '7' => "July",
            '8' => "August",
            '9' => "September",
            '10' => "October",
            '11' => "November",
            '12' => "December",
        ];
        return $month_arr[$monthNum];
    }

    private function addAgence($total_sims,$agences_array,$id,$intitule) {
        $colors = [
            ['hue' => 0, 'hex' => "#ff0000", 'rgb' => "rgb(255, 0, 0)", 'hsl' => "hsl(0, 100%, 50%)"],
            ['hue' => 45, 'hex' => "#ffff00", 'rgb' => "rgb(255, 255, 0)", 'hsl' => "hsl(60, 100%, 50%)"],
            ['hue' => 105, 'hex' => "#00ff00", 'rgb' => "rgb(0, 255, 0)", 'hsl' => "hsl(120, 100%, 50%)"],
            ['hue' => 90, 'hex' => "#40ff00", 'rgb' => "rgb(64, 255, 0)", 'hsl' => "hsl(105, 100%, 50%)"],
            ['hue' => 135, 'hex' => "#00ff40", 'rgb' => "rgb(0, 255, 64)", 'hsl' => "hsl(135, 100%, 50%)"],
            ['hue' => 180, 'hex' => "#00ffff", 'rgb' => "rgb(0, 255, 255)", 'hsl' => "hsl(180, 100%, 50%)"],
            ['hue' => 75, 'hex' => "#80ff00", 'rgb' => "rgb(128, 255, 0)", 'hsl' => "hsl(90, 100%, 50%)"],
            ['hue' => 225, 'hex' => "#0040ff", 'rgb' => "rgb(0, 64, 255)", 'hsl' => "hsl(225, 100%, 50%)"],
            ['hue' => 60, 'hex' => "#bfff00", 'rgb' => "rgb(191, 255, 0)", 'hsl' => "hsl(75, 100%, 50%)"],
            ['hue' => 270, 'hex' => "#8000ff", 'rgb' => "rgb(128, 0, 255)", 'hsl' => "hsl(270, 100%, 50%)"],
            ['hue' => 30, 'hex' => "#ff8000", 'rgb' => "rgb(255, 191, 0)", 'hsl' => "hsl(45, 100%, 50%)"],
            ['hue' => 315, 'hex' => "#ff00bf", 'rgb' => "rgb(255, 0, 191)", 'hsl' => "hsl(315, 100%, 50%)"],
            ['hue' => 15, 'hex' => "#ff4000", 'rgb' => "rgb(255, 64, 0)", 'hsl' => "hsl(15, 100%, 50%)"],
            ['hue' => 120, 'hex' => "#00ff40", 'rgb' => "rgb(0, 255, 0)", 'hsl' => "hsl(135, 100%, 50%)"],
        ];
        foreach ($agences_array as $index => $agence) {
            if ($agence['value'] === $id) {
                $agences_array[$index]['count']++;
                $agences_array[$index]['rate'] = $this->getRate($total_sims,$agences_array[$index]['count']);
                return $agences_array;
            }
        }
        $color_index = count($agences_array) > count($colors) ? 0 : count($agences_array);
        $agences_array[] = [
            'value' => $id,
            'label' => $intitule,
            'count' => 1,
            'rate' =>  $this->getRate($total_sims,1),
            'color' => $colors[$color_index]
        ];
        return $agences_array;
    }

    private function getRate($total,$val) {
        return round(( $val / $total ) * 100, 2);
    }

    private function distributeValues($esims,$agences,$days,$month,$year) {
        $distributed_values_byday = [];
        $distributed_values_byagence = [];

        // init by day
        foreach ($days as $day) {
            $init_day = [];
            foreach ($agences as $agence) {
                $init_day[] = 0;
            }
            $distributed_values_byday[$year.'-'.$month.'-'.$day] = $init_day;
        }
        // init by agence
        foreach ($agences as $agence) {
            $init_agence = [];
            foreach ($days as $day) {
                $init_agence[$day] = 0;
            }
            $distributed_values_byagence[$agence['label']] = $init_agence;
        }

        foreach ($esims as $index => $esim) {
            $esim_day = Carbon::parse($esim->phonenum->created_at)->day;
            $esim_date = $year.'-'.$month.'-'.Carbon::parse($esim->phonenum->created_at)->day;

            if ( $esim->phonenum->creator ) {
                $agence_idx = $this->getAgenceIndex($agences, $esim->phonenum->creator->employe->departement->id);
                $distributed_values_byday[$esim_date][$agence_idx]++;
                $distributed_values_byagence[$esim->phonenum->creator->employe->departement->intitule][$esim_day]++;
            } else {
                $distributed_values_byday[$esim_date][0]++;
                $distributed_values_byagence[$agences[0]['label']][$esim_day]++;
            }
        }
        return [
            'by_day' => $distributed_values_byday,
            'by_agence' => $distributed_values_byagence,
        ];
    }

    private function getAgenceIndex($agences,$id) {
        foreach ($agences as $index => $agence) {
            if ($agence['value'] === $id) {
                return $index;
            }
        }
        return -1;
    }
}
