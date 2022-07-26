<?php

namespace App\Repositories\Eloquent;

use App\Search\Queries\Search;
use App\Search\Queries\HowToSearch;
use App\Http\Requests\ISearchFormRequest;
use App\Repositories\Contracts\IHowToRepositoryContract;

class HowToRepository implements IHowToRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function search(ISearchFormRequest $request): Search
    {
        return new HowToSearch(
            $request->requestParams(), $request->requestOrder()
        );
    }
}
