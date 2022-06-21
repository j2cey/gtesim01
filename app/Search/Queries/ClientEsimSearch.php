<?php

namespace App\Search\Queries;

use App\Models\Esims\ClientEsim;
use Illuminate\Database\Eloquent\Builder;

class ClientEsimSearch extends Search
{
    use EloquentSearch;

    /**
     * @inheritDoc
     */
    protected function query(): Builder
    {
        $query = ClientEsim::query();
        $user = auth()->user();
        
        if ($this->params->search->hasFilter()) {
            $query
                ->where('nom_raison_sociale', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('prenom', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('email', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('numero_telephone', 'like', '%'.$this->params->search->search.'%');
        }

        return $query;
    }
}
