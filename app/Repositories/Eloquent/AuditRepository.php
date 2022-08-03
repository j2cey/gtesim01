<?php

namespace App\Repositories\Eloquent;

use App\Search\Queries\Search;
use App\Search\Queries\AuditSearch;
use App\Http\Requests\ISearchFormRequest;
use App\Repositories\Contracts\IAuditRepositoryContract;

class AuditRepository implements IAuditRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function search(ISearchFormRequest $request): Search
    {
        return new AuditSearch(
            $request->requestParams(), $request->requestOrder()
        );
    }
}
