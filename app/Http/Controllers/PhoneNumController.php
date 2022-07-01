<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoneNumRequest;
use App\Http\Requests\UpdatePhoneNumRequest;
use App\Models\PhoneNum;

class PhoneNumController extends Controller
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
     * @param  \App\Http\Requests\StorePhoneNumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhoneNumRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhoneNum  $phoneNum
     * @return \Illuminate\Http\Response
     */
    public function show(PhoneNum $phoneNum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhoneNum  $phoneNum
     * @return \Illuminate\Http\Response
     */
    public function edit(PhoneNum $phoneNum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhoneNumRequest  $request
     * @param  \App\Models\PhoneNum  $phoneNum
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhoneNumRequest $request, PhoneNum $phoneNum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhoneNum  $phoneNum
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhoneNum $phoneNum)
    {
        //
    }
}
