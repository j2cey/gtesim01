<?php

namespace App\Http\Controllers\Howtos;

use App\Models\Howtos\HowtoStep;
use App\Http\Controllers\Controller;
use App\Http\Requests\HowtoStep\StoreHowtoStepRequest;
use App\Http\Requests\HowtoStep\UpdateHowtoStepRequest;

class HowtoStepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
