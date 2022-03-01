<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transaksi.index',[
            'transaksi' => Transaksi::all(),
            'outlet' => Outlet::all(),
            'member' => Member::all(),
            'user' => User::all(),
            'paket' => Paket::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.transaksi.create',[
            'transaksi' => Transaksi::all(),
            'outlet' => Outlet::all(),
            'member' => Member::all(),
            'user' => User::all(),
            'paket' => Paket::all()
        ]);
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
            'id_paket' =>'required',
            'dibayar' =>'required',
            'deadline' =>'required',
            'id_member' => 'required'
        ]);

        $request['id_outlet']= auth()->user()->id_outlet;
        $request['kode_invoice']= Transaksi::createInvoice();
        $request['tgl']= date('Y-m-d');
        $request['status']= 'baru';
        $request['dibayar']= $request->dibayar;
        $request['id_user']=auth()->user()->id;
        $request['deadline']= $request->deadline;


        $input_transaksi = Transaksi::create($request->all());
        if($input_transaksi == NULL){
            return back()->withErrors([
                'transaksi' => 'Input Transaksi Gagal',
            ]);
        }

        foreach($request->id_paket as $i => $v){
            $input_detail = DetailTransaksi::create([
                'id_transaksi' => $input_transaksi->id,
                'id_paket' => $v,
                'qty' => $request->qty[$i],
                'keterangan' => ''
            ]);
        }
        return redirect('admin/transaksi')->with('success','success');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
