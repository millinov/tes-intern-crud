<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use App\Http\Requests\StoreKontrakRequest;
use App\Http\Requests\UpdateKontrakRequest;

class KontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kontrak = Kontrak::latest();
        return [
            "status" => 1,
            "data" => $kontrak
        ];
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
     * @param  \App\Http\Requests\StoreKontrakRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKontrakRequest $request)
    {
        $request->validate([
            'lama_kontrak' => 'required|max:255',
            'gaji_per_bulan' => 'required'
        ]);

        $kontrak = Kontrak::create($request->all());

        return [
            "status" => 1,
            "data" => $kontrak
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function show(Kontrak $kontrak)
    {
        return [
            "status" => 1,
            "data" => $kontrak
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontrak $kontrak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKontrakRequest  $request
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKontrakRequest $request, Kontrak $kontrak)
    {
        $request->validate([
            'lama_kontrak' => 'required|max:255',
            'gaji_per_bulan' => 'required'
        ]);

        $kontrak->update($request->all());

        return [
            "status" => 1,
            "data" => $kontrak
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontrak $kontrak)
    {
        $kontrak->delete();
        return[
            "status" => 1,
            "data" => $kontrak,
            "msg" => "Kontrak sudah di hapus."
        ];
    }
}
