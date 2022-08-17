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
        $esimsattribuees_mensuel_req = Esim::with(['phonenum','phonenum.creator','phonenum.creator.employe.departement'])
            ->whereHas('statutesim', function ($query) use ($statutesim_attribue) {
                $query->where( 'id', $statutesim_attribue->id );
            })
            ->whereHas('phonenum', function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()]);
            });

        dd($esimsattribuees_mensuel_req->get());

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

        $lava = new Lavacharts();

        $clientsesimTable = $lava->DataTable();

        $clientsesimTable->addDateColumn('Day of Month')
            ->addNumberColumn('Projected')
            ->addNumberColumn('Official');

        // Random Data For Example
        for ($a = 1; $a < 30; $a++) {
            $rowData = [
                "2017-4-$a", rand(800,1000), rand(800,1000)
            ];

            $clientsesimTable->addRow($rowData);
        }

        $lava->BarChart('Stocks', $clientsesimTable, [
            'title' => 'Stock Market Trends',
            'animation' => [
                'startup' => true,
                'easing' => 'inAndOut'
            ],
            'legend' => ['position' => 'top'],
            'colors' => ['blue', '#F4C1D8']
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

        dd($agences_actives);

        return view('dashboards.index')
            ->with('esimslibres', $esimslibres)
            ->with('esimsattribuees', $esimsattribuees)
            ->with('clientsesim', $clientsesim)
            ->with('usersactive', $usersactive)
            ->with('clientsesimTable', $clientsesimTable)
            ->with('lava', $lava);
    }

    private function getMonthStats($month) {
        $statutesim_attribue = StatutEsim::attribue()->first();
        $firstDay_ofMonth = Carbon::create(Carbon::now()->year, $month, 1, 0);

        // toutes les sims attribuées durant ce mois
        $esimsattribuees_req = Esim::with(['phonenum','phonenum.creator','phonenum.creator.employe.departement'])
            ->whereHas('statutesim', function ($query) use ($statutesim_attribue) {
                $query->where( 'id', $statutesim_attribue->id );
            })
            ->whereHas('phonenum', function ($query) use ($firstDay_ofMonth) {
                $query->whereBetween('created_at', [$firstDay_ofMonth->startOfMonth(),$firstDay_ofMonth->endOfMonth()]);
            });
        $esimsattribuees = $esimsattribuees_req->get();

        // les agences actives du mois (les courbes)
        $agences_actives = [];
        foreach ($esimsattribuees as $esim) {
            if ($esim->phonenum && $esim->phonenum->creator && $esim->phonenum->creator->employe) {
                $creator = $esim->phonenum->creator;
                $agences_actives = $this->addAgence($esimsattribuees->count(),$agences_actives,$creator->employe->departement->id,$creator->employe->departement->intitule);
            }
        }

        // jours du mois les x
        $jours_duMois = [];
        for ($i = 1; $i <= $firstDay_ofMonth->endOfMonth()->day; $i++) {
            $jours_duMois[] = $i;
        }

        // remplissage des valeurs (les y)
        $valeurs_ordonnees = [];
    }

    private function addAgence($total_sims,$agences_array,$id,$intitule) {
        foreach ($agences_array as $index => $agence) {
            if ($agence['value'] === $id) {
                $agences_array[$index]['count']++;
                $agences_array[$index]['rate'] = $this->getRate($total_sims,$agences_array[$index]['count']);
                return $agences_array;
            }
        }
        $agences_array[] = ['value' => $id, 'label' => $intitule, 'count' => 1, 'rate' =>  $this->getRate($total_sims,1)];
        return $agences_array;
    }

    private function getRate($total,$val) {
        return round(( $val / $total ) * 100, 2);
    }

    private function distributeValues($esims,$agences,$jours) {
        $distributed_values = [];
        foreach ($esims as $index => $esim) {
            
        }
    }
}
