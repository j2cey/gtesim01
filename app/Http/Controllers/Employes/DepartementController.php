<?php

namespace App\Http\Controllers\Employes;

use App\Models\Employes\Departement;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepartementRequest $request
     * @return void
     */
    public function store(StoreDepartementRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Departement $departement
     * @return void
     */
    public function show(Departement $departement): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Departement $departement
     * @return void
     */
    public function edit(Departement $departement): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDepartementRequest $request
     * @param Departement $departement
     * @return void
     */
    public function update(UpdateDepartementRequest $request, Departement $departement): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Departement $departement
     * @return void
     */
    public function destroy(Departement $departement): void
    {
        //
    }
}
