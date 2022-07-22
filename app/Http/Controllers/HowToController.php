<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHowToRequest;
use App\Http\Requests\UpdateHowToRequest;
use App\Models\HowTo;

class HowToController extends Controller
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
     * @param  \App\Http\Requests\StoreHowToRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHowToRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HowTo  $howTo
     * @return \Illuminate\Http\Response
     */
    public function show(HowTo $howTo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HowTo  $howTo
     * @return \Illuminate\Http\Response
     */
    public function edit(HowTo $howTo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHowToRequest  $request
     * @param  \App\Models\HowTo  $howTo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHowToRequest $request, HowTo $howTo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HowTo  $howTo
     * @return \Illuminate\Http\Response
     */
    public function destroy(HowTo $howTo)
    {
        //
    }
}
