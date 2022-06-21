<?php

namespace App\Http\Controllers\Esims;

use PDF;
use Exception;
use \Illuminate\View\View;
use App\Models\Esims\ClientEsim;

use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Resources\SearchCollection;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Http\Requests\ClientEsim\FetchRequest;
use App\Http\Resources\Esims\ClientEsimResource;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\ClientEsim\StoreClientEsimRequest;
use App\Http\Requests\ClientEsim\UpdateClientEsimRequest;
use App\Repositories\Contracts\IClientEsimRepositoryContract;

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

    public function generatePDF($id)
    {
        $client = new ClientEsimResource(ClientEsim::where('id', $id)->first());
        $acqrcode = QrCode::size(100)->generate($client->esim->ac);

        $pdf = PDF::loadView('clientesims.preview', ['client' => $client, 'acqrcode' => $acqrcode, 'generate_now' => true]);    
        return $pdf->download('clientesims.pdf');
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
        $clientesim = ClientEsim::createNew(
            $request->esim_id,
            $request->nom_raison_sociale,
            $request->prenom,
            $request->email,
            $request->numero_telephone
        );
        return new ClientEsimResource($clientesim);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientEsim  $clientEsim
     * @return \Illuminate\Http\Response
     */
    public function show(ClientEsim $clientesim)
    {
        $client = new ClientEsimResource($clientesim);
        $acqrcode = QrCode::size(100)->generate($client->esim->ac);
        
        return view('clientesims.preview')
            ->with('acqrcode', $acqrcode)
            ->with('client', $client);
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
