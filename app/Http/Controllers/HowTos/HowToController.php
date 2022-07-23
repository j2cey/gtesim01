<?php

namespace App\Http\Controllers\HowTos;

use \Illuminate\View\View;
use App\Models\HowTos\HowTo;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use App\Http\Resources\SearchCollection;
use App\Http\Requests\HowTo\FetchRequest;
use App\Http\Resources\HowTos\HowToResource;
use App\Http\Requests\HowTo\StoreHowToRequest;
use App\Http\Requests\HowTo\UpdateHowToRequest;
use Illuminate\Contracts\Foundation\Application;
use App\Repositories\Contracts\IHowToRepositoryContract;

class HowToController extends Controller
{
    /**
     * @var IHowToRepositoryContract
     */
    private $repository;

    /**
     * ClientEsimController constructor.
     *
     * @param IHowToRepositoryContract $repository [description]
     */
    public function __construct(IHowToRepositoryContract $repository) {
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
            $this->repository->search($request), HowToResource::class
        );
    }

    public function fetchall() {
        return HowTo::all();
    }

    /**
     * Display products page.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        return view('howtos.index')
            ->with('perPage', new Collection(config('system.per_page')))
            ->with('defaultPerPage', config('system.default_per_page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHowToRequest $request
     * @return HowToResource
     */
    public function store(StoreHowToRequest $request): HowToResource
    {
        $howto = HowTo::createNew(
            $request->howtotype,
            $request->title,
            $request->view,
            $request->description,
            null,
            $request->code,
            $request->tags
        );
        return new HowToResource($howto);
    }

    /**
     * Display the specified resource.
     *
     * @param HowTo $howto
     * @return void
     */
    public function show(HowTo $howto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HowTo $howto
     * @return void
     */
    public function edit(HowTo $howto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHowToRequest $request
     * @param HowTo $howto
     * @return HowToResource
     */
    public function update(UpdateHowToRequest $request, HowTo $howto)
    {
        $howto->updateOne(
            $request->howtotype,
            $request->title,
            $request->view,
            $request->description,
            null,
            $request->code,
            $request->tags
        );
        return new HowToResource($howto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HowTo $howto
     * @return void
     */
    public function destroy(HowTo $howto)
    {
        //
    }
}
