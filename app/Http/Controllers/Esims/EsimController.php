<?php

namespace App\Http\Controllers\Esims;

use Exception;
use App\Models\Esims\Esim;
use \Illuminate\View\View;

use Illuminate\Http\Request;
use App\Models\Esims\StatutEsim;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\Esim\StoreEsimRequest;
use App\Http\Requests\Esim\FetchRequest;

use App\Http\Requests\Esim\UpdateEsimRequest;
use App\Http\Resources\SearchCollection;
use App\Http\Resources\Esims\EsimResource;
use App\Models\Esims\EsimBodyFile;
use App\Models\Esims\EsimHeadFile;
use Illuminate\Contracts\Foundation\Application;
use App\Repositories\Contracts\IEsimRepositoryContract;

class EsimController extends Controller
{
    /**
     * @var IEsimRepositoryContract
     */
    private $repository;

    /**
     * EsimController constructor.
     *
     * @param IEsimRepositoryContract $repository [description]
     */
    public function __construct(IEsimRepositoryContract $repository) {
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
            $this->repository->search($request), EsimResource::class
        );
    }

    public function fetchall() {
        return Esim::all();
    }

    /**
     * Display products page.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $statutesims = StatutEsim::all();
        return view('esims.index')
            ->with('perPage', new Collection(config('system.per_page')))
            ->with('defaultPerPage', config('system.default_per_page'))
            ->with('statutesims', $statutesims);
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
     * @param  \App\Http\Requests\StoreEsimRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEsimRequest $request)
    {
        $esim = Esim::createNew(
            $request->imsi,
            $request->iccid,
            $request->ac,
            $request->pin,
            $request->puk
        );
        return new EsimResource($esim);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Esim  $esim
     * @return \Illuminate\Http\Response
     */
    public function show(Esim $esim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Esim  $esim
     * @return \Illuminate\Http\Response
     */
    public function edit(Esim $esim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEsimRequest  $request
     * @param  \App\Models\Esim  $esim
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEsimRequest $request, Esim $esim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Esim  $esim
     * @return \Illuminate\Http\Response
     */
    public function destroy(Esim $esim)
    {
        //
    }
    
    public function headfiles()
    {
        return view('esims.headfiles');
    }
    
    public function headfilespost(Request $request)
    {
        $formInput = $request->all();

        $new_esimheadfile = EsimHeadFile::create();

        $new_esimheadfile->verifyAndStoreFile( $request, "esim_fichier", "fichier", "esim_fichier_entete");
    }

    public function bodyfiles()
    {
        return view('esims.bodyfiles');
    }
    
    public function bodyfilespost(Request $request)
    {
        $formInput = $request->all();

        $new_esimbodyfile = EsimBodyFile::create();

        $new_esimbodyfile->verifyAndStoreFile( $request, "esim_fichier", "fichier", "esim_fichier_corps");
    }
}
