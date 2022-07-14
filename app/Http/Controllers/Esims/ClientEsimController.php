<?php

namespace App\Http\Controllers\Esims;

use PDF;
use \Illuminate\View\View;
use App\Models\Esims\ClientEsim;
use Illuminate\Support\Collection;
use App\Jobs\ClientEsimSendMailJob;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use App\Http\Resources\SearchCollection;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\ClientEsim\FetchRequest;
use App\Http\Resources\Esims\ClientEsimResource;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\ClientEsim\StoreClientEsimRequest;
use App\Http\Requests\ClientEsim\UpdateClientEsimRequest;
use App\Repositories\Contracts\IClientEsimRepositoryContract;
use PhpParser\Node\Expr\Ternary;

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

    public function previewPDF($id) {

        $client = new ClientEsimResource(ClientEsim::where('id', $id)->first());
        //dd($client);
        //$acqrcode = QrCode::size(100)->generate($client->esim->ac);
        return view('clientesims.preview')
            ->with('client', $client);
    }

    public function generatePDF($id)
    {
        $client = new ClientEsimResource(ClientEsim::where('id', $id)->first());
        $acqrcode = QrCode::size(100)->generate($client->esim->ac);

        $pdf = PDF::loadView('clientesims.preview', ['client' => $client, 'acqrcode' => $acqrcode, 'generate_now' => true])->setPaper('a4', 'portrait');

        $pdf->getDomPDF()->setHttpContext(
            stream_context_create([
                'ssl' => [
                    'allow_self_signed'=> TRUE,
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                ]
            ])
        );

        return $pdf->download('clientesims.pdf');
    }

    public function preprintPDF($id)
    {
        $client = new ClientEsimResource(ClientEsim::where('id', $id)->first());
        $acqrcode = QrCode::size(100)->generate($client->esim->ac);

        $pdf = PDF::loadView('clientesims.preview', ['client' => $client, 'acqrcode' => $acqrcode, 'generate_now' => true]);

        return $pdf->setPaper('a4', 'portrait')->stream();
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

    public function checkbeforecreate(StoreClientEsimRequest $request)
    {
        $clientsesims_matched = ClientEsim::where('nom_raison_sociale','LIKE', '%' . $request->nom_raison_sociale . '%')
        ->where('prenom', 'LIKE', '%' . $request->prenom . '%')
        ->get();

        $res = [
            'action_type' => 0,
            'val' => null,
        ];

        if ( $clientsesims_matched->count() > 0 ) {
            // some matches
            $res['action_type'] = 1;
            $res['val'] = $clientsesims_matched;
        } else {
            // no match
            $res['action_type'] = 2;
        }

        return response()->json([
            'data' => $res
        ], 200);
    }

    public function store(StoreClientEsimRequest $request)
    {
        return $this->storeclientesim($request);
    }

    public function storeclientesim(StoreClientEsimRequest $request) {
        $clientesim = ClientEsim::createNew(
            $request->esim_id,
            $request->nom_raison_sociale,
            $request->prenom,
            $request->email,
            $request->numero_telephone
        );

        //Mail::to($clientesim->email)->send(new NotifyProfileEsim($clientesim));

        ClientEsimSendMailJob::dispatch($clientesim);

        return new ClientEsimResource($clientesim);
    }

    public function mailtest($id)
    {
        $clientesim = ClientEsim::where('id', $id)->first();
        $clientesim->esim->saveQrcode();
        //Mail::to($clientesim->email)->send(new NotifyProfileEsim($clientesim));
    }

    public function sendMail($id)
    {
        $clientesim = ClientEsim::where('id', $id)->first();

        $response = $clientesim->sendmailprofile();

        dd($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientEsim  $clientEsim
     * @return \Illuminate\Http\Response
     */
    public function show(ClientEsim $clientesim)
    {
        return view('clientesims.show')
            ->with('clientesim', new ClientEsimResource($clientesim));
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
    public function update(UpdateClientEsimRequest $request, ClientEsim $clientesim)
    {
        $clientesim = $clientesim->updateOne(
            $request->esim_id,
            $request->nom_raison_sociale,
            $request->prenom,
            $request->email,
            $request->numero_telephone
        );
        return new ClientEsimResource($clientesim);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientEsim  $clientEsim
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientEsim $clientesim)
    {
        $clientesim->load('esim');
        $esim = $clientesim->esim;
        $esim->setStatutFree();

        return redirect()->route('clientesims.index');
    }
}
