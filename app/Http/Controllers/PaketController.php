<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.paket.index',[
            'paket' => Paket::all(),
            'outlet' => Outlet::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'id_outlet' => 'required',
            'nama_paket' =>'required',
            'jenis' =>'required',
            'harga' =>'required'
        ]);

        $paket = Paket::create([
            'id_outlet' => $request->id_outlet,
            'nama_paket' => $request->nama_paket,
            'jenis' => $request->jenis,
            'harga' => $request->harga
        ]);
        return redirect('admin/paket')->with('success','success');
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
            'id_outlet' => 'required',
            'nama_paket' =>'required',
            'jenis' =>'required',
            'harga' =>'required'
        ]);

        $paket = Paket::findOrFail($id);
        $paket ->update([
            'id_outlet' => $request->id_outlet,
            'nama_paket' => $request->nama_paket,
            'jenis' => $request->jenis,
            'harga' => $request->harga
        ]);
        return redirect('admin/paket')->with('edited','edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Paket = Paket::findOrFail($id);
            $Paket->delete();
            return redirect('admin/paket');
    }
}
