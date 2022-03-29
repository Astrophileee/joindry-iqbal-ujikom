<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\PaketExport;
use App\Imports\PaketImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
            'paket' => Paket::Where('id_outlet',Auth::user()->id_outlet)->get(),
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
            'nama_paket' =>'required',
            'jenis' =>'required',
            'harga' =>'required'
        ]);

        $paket = Paket::create([
            'id_outlet' => Auth::user()->id_outlet,
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
            'nama_paket' =>'required',
            'jenis' =>'required',
            'harga' =>'required'
        ]);

        $paket = Paket::findOrFail($id);
        $paket ->update([
            'id_outlet' => Auth::user()->id_outlet,
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

    public function exportExcel(){
        return Excel::download(new PaketExport, 'DataPaket.xlsx');
    }

    public function importExcel(Request $request){
        $request->validate([
            'file_import' => 'required|file|mimes:xlsx'
        ]);

        Excel::import(new PaketImport,$request->file('file_import'));

        return redirect()->back();
    }

    public function templateExcel(){
        return Storage::download('template/Template_Paket_Cucian.xlsx');
    }

    public function dataPaket(){

        $data = Paket::all();
        return $data;
    }
    //menyimpan data penjemputan ke file pdf
    public function exportPaketPDF()
    {
        $data = $this->DataPaket();
        $pdf  = Pdf::loadView('admin.paket.pdf', compact('data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-paket.pdf');
    }
}
