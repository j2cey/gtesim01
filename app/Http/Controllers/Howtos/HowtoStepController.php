<?php

namespace App\Http\Controllers\Howtos;


use \Illuminate\View\View;
use App\Models\Howtos\HowtoStep;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use App\Http\Resources\SearchCollection;
use App\Http\Requests\HowtoStep\FetchRequest;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Resources\Howtos\HowtoStepResource;
use App\Http\Requests\HowtoStep\StoreHowtoStepRequest;
use App\Http\Requests\HowtoStep\UpdateHowtoStepRequest;
use App\Repositories\Contracts\IHowtoStepRepositoryContract;

class HowtoStepController extends Controller
{
    /**
     * @var IHowtoStepRepositoryContract
     */
    private $repository;

    /**
     * ClientEsimController constructor.
     *
     * @param IHowtoStepRepositoryContract $repository [description]
     */
    public function __construct(IHowtoStepRepositoryContract $repository) {
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
            $this->repository->search($request), HowtoStepResource::class
        );
    }

    public function fetchall() {
        return HowtoStep::all();
    }

    /**
     * Display products page.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        return view('howtosteps.index')
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
     * @param StoreHowtoStepRequest $request
     * @return void
     */
    public function store(StoreHowtoStepRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param HowtoStep $howtostep
     * @return void
     */
    public function show(HowtoStep $howtostep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HowtoStep $howtostep
     * @return void
     */
    public function edit(HowtoStep $howtostep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHowtoStepRequest $request
     * @param HowtoStep $howtostep
     * @return void
     */
    public function update(UpdateHowtoStepRequest $request, HowtoStep $howtostep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HowtoStep $howtostep
     * @return void
     */
    public function destroy(HowtoStep $howtostep)
    {
        //
    }
}
