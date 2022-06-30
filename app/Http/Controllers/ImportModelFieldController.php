<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImportModelFieldRequest;
use App\Http\Requests\UpdateImportModelFieldRequest;
use App\Models\ImportModelField;

class ImportModelFieldController extends Controller
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
     * @param  \App\Http\Requests\StoreImportModelFieldRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImportModelFieldRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImportModelField  $importModelField
     * @return \Illuminate\Http\Response
     */
    public function show(ImportModelField $importModelField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImportModelField  $importModelField
     * @return \Illuminate\Http\Response
     */
    public function edit(ImportModelField $importModelField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImportModelFieldRequest  $request
     * @param  \App\Models\ImportModelField  $importModelField
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImportModelFieldRequest $request, ImportModelField $importModelField)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImportModelField  $importModelField
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImportModelField $importModelField)
    {
        //
    }
}
