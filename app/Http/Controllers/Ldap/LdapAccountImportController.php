<?php

namespace App\Http\Controllers\Ldap;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLdapAccountImportRequest;
use App\Http\Requests\UpdateLdapAccountImportRequest;
use App\Models\Ldap\LdapAccountImport;

class LdapAccountImportController extends Controller
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
     * @param StoreLdapAccountImportRequest $request
     * @return Response
     */
    public function store(StoreLdapAccountImportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param LdapAccountImport $ldapaccountimport
     * @return void
     */
    public function show(LdapAccountImport $ldapaccountimport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LdapAccountImport $ldapaccountimport
     * @return void
     */
    public function edit(LdapAccountImport $ldapaccountimport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLdapAccountImportRequest $request
     * @param LdapAccountImport $ldapaccountimport
     * @return void
     */
    public function update(UpdateLdapAccountImportRequest $request, LdapAccountImport $ldapaccountimport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LdapAccountImport $ldapaccountimport
     * @return void
     */
    public function destroy(LdapAccountImport $ldapaccountimport)
    {
        //
    }
}
