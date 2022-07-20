<?php


namespace App\Search\Queries;

use Spatie\Tags\Tag;
use App\Models\Howtos\HowtoStep;

class HowtoStepSearch extends Search
{
    use EloquentSearch;

    /**
     * @inheritDoc
     */
    protected function query() //: Builder
    {
        $query = HowtoStep::query();
        $tags = Tag::containing($this->params->search->search)->get()->pluck('name')->toArray();

        if ($this->params->search->hasFilter()) {
            $query->withAnyTags($tags)
                ->where('title', 'like', '%'.$this->params->search->search.'%')
                ->orWhere('description', 'like', '%'.$this->params->search->search.'%');
        }

        return $query;
    }
}
