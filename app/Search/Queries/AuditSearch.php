<?php


namespace App\Search\Queries;


use OwenIt\Auditing\Models\Audit;
use Illuminate\Database\Eloquent\Builder;

class AuditSearch extends Search
{
    use EloquentSearch;

    /**
     * @inheritDoc
     */
    protected function query() : Builder
    {
        $query = Audit::query();

        //dd($tags);

        if ($this->params->search->hasFilter()) {
            $query->with('user')
                ->where('event', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('auditable_type', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('user_type', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('old_values', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('new_values', 'like', '%'.$this->params->search->search.'%');
        }
        return $query;
    }
}
