<?php

namespace App\Http\Controllers\Employes;

use App\Http\Controllers\Controller;
use App\Models\Employes\TypeDepartement;
use App\Http\Requests\StoreTypeDepartementRequest;
use App\Http\Requests\UpdateTypeDepartementRequest;

class TypeDepartementController extends Controller
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
     * @param StoreTypeDepartementRequest $request
     * @return void
     */
    public function store(StoreTypeDepartementRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param TypeDepartement $typedepartement
     * @return void
     */
    public function show(TypeDepartement $typedepartement): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TypeDepartement $typedepartement
     * @return void
     */
    public function edit(TypeDepartement $typedepartement): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTypeDepartementRequest $request
     * @param TypeDepartement $typedepartement
     * @return void
     */
    public function update(UpdateTypeDepartementRequest $request, TypeDepartement $typedepartement): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TypeDepartement $typedepartement
     * @return void
     */
    public function destroy(TypeDepartement $typedepartement): void
    {
        //
    }
}
