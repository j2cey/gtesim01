<?php

namespace App\Http\Requests\Audit;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\ISearchFormRequest;

class FetchRequest extends AuditRequest implements ISearchFormRequest
{
    use SearchRequest;

    /**
     * @inheritDoc
     */
    protected function orderByFields(): array
    {
        return ['id','created_at'];
    }

    /**
     * @inheritDoc
     */
    protected function defaultOrderByField(): string
    {
        return 'created_at';
    }

    protected function getCustomPayload()
    {
        return $this->search;
    }
}
