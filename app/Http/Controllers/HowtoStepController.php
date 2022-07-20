<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHowtoStepRequest;
use App\Http\Requests\UpdateHowtoStepRequest;
use App\Models\HowtoStep;

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
     * @param  \App\Http\Requests\StoreHowtoStepRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHowtoStepRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HowtoStep  $howtoStep
     * @return \Illuminate\Http\Response
     */
    public function show(HowtoStep $howtoStep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HowtoStep  $howtoStep
     * @return \Illuminate\Http\Response
     */
    public function edit(HowtoStep $howtoStep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHowtoStepRequest  $request
     * @param  \App\Models\HowtoStep  $howtoStep
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHowtoStepRequest $request, HowtoStep $howtoStep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HowtoStep  $howtoStep
     * @return \Illuminate\Http\Response
     */
    public function destroy(HowtoStep $howtoStep)
    {
        //
    }
}
