<?php

namespace App\Http\Controllers;

use App\Models\Barang2;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.barang.index',[
            'barang' => Barang2::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' =>'required',
            'merk_barang' =>'required',
            'qty' =>'required',
            'kondisi' =>'required',
            'tanggal_pengadaan' =>'required'
        ]);

        $paket = Barang2::create([
            'nama_barang' => $request->nama_barang,
            'merk_barang' => $request->merk_barang,
            'qty' => $request->qty,
            'kondisi' => $request->kondisi,
            'tanggal_pengadaan' => $request->tanggal_pengadaan
        ]);
        return redirect('admin/barang')->with('success','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' =>'required',
            'merk_barang' =>'required',
            'qty' =>'required',
            'kondisi' =>'required',
            'tanggal_pengadaan' =>'required'
        ]);

        $paket = Barang2::findOrFail($id);
        $paket ->update([
            'nama_barang' => $request->nama_barang,
            'merk_barang' => $request->merk_barang,
            'qty' => $request->qty,
            'kondisi' => $request->kondisi,
            'tanggal_pengadaan' => $request->tanggal_pengadaan
        ]);
        return redirect('admin/barang')->with('edited','edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = barang2::findOrFail($id);
            $barang->delete();
            return redirect('admin/barang');
    }
}
