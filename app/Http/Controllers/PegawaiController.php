<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $pegawai
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
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePegawaiRequest $request)
    {
        $request->validate([
            'nama_pegawai' => 'required|max:255',
            'no_telp' => ['required','min:10','max:255','unique:App\Models\Pegawai'],
            'email' => ['required','email:dns','unique:App\Models\Pegawai'],
            'jabatan_id' => 'required',
            'kontrak_id' => 'required',
        ]);

        $pegawai = Pegawai::create($request->all());

        return [
            "status" => 1,
            "data" => $pegawai
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        return [
            "status" => 1,
            "data" => $pegawai
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePegawaiRequest  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_pegawai' => 'required|max:255',
            'no_telp' => ['required','min:10','max:255','unique:App\Models\Pegawai'],
            'email' => ['required','email:dns','unique:App\Models\Pegawai'],
            'jabatan_id' => 'required',
            'kontrak_id' => 'required',
        ]);

        $pegawai->update($request->all());

        return [
            "status" => 1,
            "data" => $pegawai
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return[
            "status" => 1,
            "data" => $pegawai,
            "msg" => "Pegawai sudah di hapus."
        ];
    }
}
