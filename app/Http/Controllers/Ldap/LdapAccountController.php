<?php

namespace App\Http\Controllers\Ldap;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLdapAccountRequest;
use App\Http\Requests\UpdateLdapAccountRequest;
use App\Models\Ldap\LdapAccount;

class LdapAccountController extends Controller
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
     * @param StoreLdapAccountRequest $request
     * @return void
     */
    public function store(StoreLdapAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param LdapAccount $ldapaccount
     * @return void
     */
    public function show(LdapAccount $ldapaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LdapAccount $ldapaccount
     * @return void
     */
    public function edit(LdapAccount $ldapaccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLdapAccountRequest $request
     * @param LdapAccount $ldapaccount
     * @return void
     */
    public function update(UpdateLdapAccountRequest $request, LdapAccount $ldapaccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LdapAccount $ldapaccount
     * @return void
     */
    public function destroy(LdapAccount $ldapaccount)
    {
        //
    }
}
