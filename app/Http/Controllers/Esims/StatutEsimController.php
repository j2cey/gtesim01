<?php

namespace App\Http\Controllers\Esims;

use App\Models\StatutEsim;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatutEsimRequest;
use App\Http\Requests\UpdateStatutEsimRequest;

class StatutEsimController extends Controller
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
     * @param  \App\Http\Requests\StoreStatutEsimRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatutEsimRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatutEsim  $statutEsim
     * @return \Illuminate\Http\Response
     */
    public function show(StatutEsim $statutEsim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatutEsim  $statutEsim
     * @return \Illuminate\Http\Response
     */
    public function edit(StatutEsim $statutEsim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatutEsimRequest  $request
     * @param  \App\Models\StatutEsim  $statutEsim
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatutEsimRequest $request, StatutEsim $statutEsim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatutEsim  $statutEsim
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatutEsim $statutEsim)
    {
        //
    }

    public function setnext(Request $request) {

    }
}
