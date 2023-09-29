<?php

namespace App\Http\Controllers\Backend\Banking;

use App\Models\Banking;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankingRequest;
use App\Http\Requests\UpdateBankingRequest;

class BankingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBankingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Banking $banking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banking $banking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBankingRequest $request, Banking $banking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banking $banking)
    {
        //
    }
}
