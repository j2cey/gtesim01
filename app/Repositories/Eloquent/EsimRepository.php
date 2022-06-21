<?php

namespace App\Repositories\Eloquent;

use App\Search\Queries\Search;
use App\Search\Queries\EsimSearch;
use App\Http\Requests\ISearchFormRequest;
use App\Repositories\Contracts\IEsimRepositoryContract;

class EsimRepository implements IEsimRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function search(ISearchFormRequest $request): Search
    {
        return new EsimSearch(
            $request->requestParams(), $request->requestOrder()
        );
    }
}
