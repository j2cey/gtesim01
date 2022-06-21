<?php

namespace App\Http\Controllers\Esims;

use App\Models\Esims\ClientEsim;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientEsim\StoreClientEsimRequest;
use App\Http\Requests\ClientEsim\UpdateClientEsimRequest;

use App\Http\Resources\Esims\ClientEsimResource;
use Illuminate\Contracts\View\Factory;
use App\Http\Resources\SearchCollection;
use App\Http\Requests\ClientEsim\FetchRequest;
use Illuminate\Contracts\Foundation\Application;
use App\Repositories\Contracts\IClientEsimRepositoryContract;

use Exception;
use \Illuminate\View\View;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;

class ClientEsimController extends Controller
{
    /**
     * @var IClientEsimRepositoryContract
     */
    private $repository;

    /**
     * ClientEsimController constructor.
     *
     * @param IClientEsimRepositoryContract $repository [description]
     */
    public function __construct(IClientEsimRepositoryContract $repository) {
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
            $this->repository->search($request), ClientEsimResource::class
        );
    }

    public function fetchall() {
        return ClientEsim::all();
    }

    /**
     * Display products page.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        return view('clientesims.index')
            ->with('perPage', new Collection(config('system.per_page')))
            ->with('defaultPerPage', config('system.default_per_page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientEsimRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientEsimRequest $request)
    {
        $esim = ClientEsim::createNew(
            $request->esim_id,
            $request->nom_raison_sociale,
            $request->prenom,
            $request->email,
            $request->numero_telephone
        );
        return new ClientEsimResource($esim);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientEsim  $clientEsim
     * @return \Illuminate\Http\Response
     */
    public function show(ClientEsim $clientEsim)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientEsim  $clientEsim
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientEsim $clientEsim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientEsimRequest  $request
     * @param  \App\Models\ClientEsim  $clientEsim
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientEsimRequest $request, ClientEsim $clientEsim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientEsim  $clientEsim
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientEsim $clientEsim)
    {
        //
    }
}
