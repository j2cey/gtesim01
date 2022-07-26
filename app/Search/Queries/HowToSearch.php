<?php


namespace App\Search\Queries;

use Spatie\Tags\Tag;
use App\Models\HowTos\HowTo;
use Illuminate\Database\Eloquent\Builder;

class HowToSearch extends Search
{
    use EloquentSearch;

    /**
     * @inheritDoc
     */
    protected function query() : Builder
    {
        $query = HowTo::query();
        $tags = is_null($this->params->search->search) ? [] : Tag::containing($this->params->search->search)->get()->pluck('name')->toArray();

        //dd($tags);

        if ($this->params->search->hasFilter()) {
            $query->withAnyTags($tags)
                ->orWhere('title', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('description', 'like', '%'.$this->params->search->search.'%');
        }
        return $query;
    }
}
