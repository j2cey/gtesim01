<?php

namespace App\Repositories\Eloquent;

use App\Search\Queries\Search;
use App\Search\Queries\ClientEsimSearch;
use App\Http\Requests\ISearchFormRequest;
use App\Repositories\Contracts\IClientEsimRepositoryContract;

class ClientEsimRepository implements IClientEsimRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function search(ISearchFormRequest $request): Search
    {
        return new ClientEsimSearch(
            $request->requestParams(), $request->requestOrder()
        );
    }
}
