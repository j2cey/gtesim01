<?php


namespace App\Repositories\Eloquent;

use App\Search\Queries\Search;
use App\Search\Queries\HowToThreadSearch;
use App\Http\Requests\ISearchFormRequest;
use App\Repositories\Contracts\IHowToThreadRepositoryContract;

class HowToThreadRepository implements IHowToThreadRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function search(ISearchFormRequest $request): Search
    {
        return new HowToThreadSearch(
            $request->requestParams(), $request->requestOrder()
        );
    }
}
