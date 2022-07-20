<?php

namespace App\Repositories\Eloquent;

use App\Search\Queries\Search;
use App\Search\Queries\HowtoStepSearch;
use App\Http\Requests\ISearchFormRequest;
use App\Repositories\Contracts\IHowtoStepRepositoryContract;

class HowtoStepRepository implements IHowtoStepRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function search(ISearchFormRequest $request): Search
    {
        return new HowtoStepSearch(
            $request->requestParams(), $request->requestOrder()
        );
    }
}
