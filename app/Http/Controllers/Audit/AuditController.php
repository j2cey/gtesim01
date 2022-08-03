<?php

namespace App\Http\Controllers\Audit;

use \Illuminate\View\View;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use App\Http\Resources\SearchCollection;
use App\Http\Requests\Audit\FetchRequest;
use App\Http\Resources\Audit\AuditResource;
use Illuminate\Contracts\Foundation\Application;
use App\Repositories\Contracts\IAuditRepositoryContract;

class AuditController extends Controller
{
    /**
     * @var IAuditRepositoryContract
     */
    private $repository;

    /**
     * ClientEsimController constructor.
     *
     * @param IAuditRepositoryContract $repository [description]
     */
    public function __construct(IAuditRepositoryContract $repository) {
        $this->repository = $repository;
    }

    /**
     * Fetch records.
     *
     * @param  FetchRequest     $request [description]
     * @return SearchCollection          [description]
     */
    public function fetch(FetchRequest $request): SearchCollection
    {
        return new SearchCollection(
            $this->repository->search($request), AuditResource::class
        );
    }

    public function fetchall() {
        return Audit::with('user')
        ->orderBy('created_at', 'desc')->get();
    }

    public function index()
    {
        return view('audits.index')
            ->with('perPage', new Collection(config('system.per_page')))
            ->with('defaultPerPage', config('system.default_per_page'));
    }
}
