<?php

namespace App\Search\Queries;

use Carbon\Carbon;
use App\Models\Esims\Esim;
use Illuminate\Database\Eloquent\Builder;

class EsimSearch extends Search
{
    use EloquentSearch;

    /**
     * @inheritDoc
     */
    protected function query(): Builder
    {
        $query = Esim::query();

        if ($this->params->search->hasFilter()) {
            $createddaterange = $this->getCreatedDateRangeCrit($this->params->search->search);
            $status = $this->getStatutCrit($this->params->search->search);
            $statutesim = $this->getStatutEsimCrit($this->params->search->search);
            if ($createddaterange) {
                $dt_deb = Carbon::createFromFormat('Y-m-d', $createddaterange[0])->addDay()->format('Y-m-d');
                $dt_fin = Carbon::createFromFormat('Y-m-d', $createddaterange[1])->addDay()->format('Y-m-d');
                $query
                    ->whereBetween('created_at', [$dt_deb,$dt_fin]);
            }
            if ($status) {
                $query
                    ->whereHas('status', function (Builder $q) use ($status) {
                        $q->where('status_id', $status);
                    });
            }
            if ($statutesim) {
                $query
                    ->whereHas('statutesim', function (Builder $q) use ($statutesim) {
                        $q->where('statut_esim_id', $statutesim);
                    });
            }
        }

        return $query;
    }

    private function getCreatedDateRangeCrit($search) {
        $search_arr = explode('|', $search);
        $dateremise_range = null;
        foreach ($search_arr as $crit) {
            $crit_arr = explode(':', $crit);
            if ($crit_arr[0] === "createdat_from") {
                $dateremise_range[0] = $crit_arr[1];
            } elseif ($crit_arr[0] === "createdat_to") {
                $dateremise_range[1] = $crit_arr[1];
            }
        }
        return is_null($dateremise_range) ? null : (count($dateremise_range) === 2 ? $dateremise_range : null);
    }

    private function getStatutCrit($search) {
        $search_arr = explode('|', $search);
        $status = null;
        foreach ($search_arr as $crit) {
            $crit_arr = explode(':', $crit);
            if ($crit_arr[0] === "status") {
                $status = $crit_arr[1];
            }
        }
        return $status;
    }

    private function getStatutEsimCrit($search) {
        $search_arr = explode('|', $search);
        $statutesimcrit = null;
        foreach ($search_arr as $crit) {
            $crit_arr = explode(':', $crit);
            if ($crit_arr[0] === "statutesim") {
                $statutesimcrit = $crit_arr[1];
            }
        }
        return $statutesimcrit;
    }
}
