<?php

namespace App\Http\Controllers\HowTos;

use App\Models\HowTos\HowToStep;
use App\Http\Controllers\Controller;
use App\Http\Requests\HowToStep\StoreHowToStepRequest;
use App\Http\Requests\HowToStep\UpdateHowToStepRequest;

class HowToStepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHowToStepRequest $request
     * @return HowToStep|void
     */
    public function store(StoreHowToStepRequest $request)
    {
        return $request->howtothread->addNewStep($request->howto, $request->posi, $request->title, $request->description);
    }

    /**
     * Display the specified resource.
     *
     * @param HowToStep $howtostep
     * @return void
     */
    public function show(HowToStep $howtostep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HowToStep $howtostep
     * @return void
     */
    public function edit(HowToStep $howtostep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHowToStepRequest $request
     * @param HowToStep $howtostep
     * @return HowToStep|void
     */
    public function update(UpdateHowToStepRequest $request, HowToStep $howtostep)
    {
        return $howtostep->updateOne($request->howto, $request->posi, $request->title, $request->description);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HowToStep $howtostep
     * @return void
     */
    public function destroy(HowToStep $howtostep)
    {
        //
    }
}
