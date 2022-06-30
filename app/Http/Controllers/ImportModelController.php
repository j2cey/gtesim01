<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImportModelRequest;
use App\Http\Requests\UpdateImportModelRequest;
use App\Models\ImportModel;

class ImportModelController extends Controller
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
     * @param  \App\Http\Requests\StoreImportModelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImportModelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImportModel  $importModel
     * @return \Illuminate\Http\Response
     */
    public function show(ImportModel $importModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImportModel  $importModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ImportModel $importModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImportModelRequest  $request
     * @param  \App\Models\ImportModel  $importModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImportModelRequest $request, ImportModel $importModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImportModel  $importModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImportModel $importModel)
    {
        //
    }
}
