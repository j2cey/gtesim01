<?php

namespace App\Search\Queries;

use App\Models\Esims\ClientEsim;
use App\Models\Employes\PhoneNum;
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
            $phonesearch = $this->params->search->search;
            $emailsearch = $this->params->search->search;
            $query
                ->where('nom_raison_sociale', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('prenom', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('email', 'like', '%'.$this->params->search->search.'%')
                ->orWhereHas('phonenums', function ($query) use ($phonesearch) {
                    $query->where( 'numero', 'like', '%'.$phonesearch.'%' );
                })
                ->orWhereHas('emailaddresses', function ($query) use ($emailsearch) {
                    $query->where( 'email', 'like', '%'.$emailsearch.'%' );
                });
        }

        return $query;
    }
}
