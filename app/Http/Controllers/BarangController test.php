<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Imports\BarangImport;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.barang.index',[
            'barang' => Barang::all()
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' =>'required',
            'waktu_beli' => 'required',
            'qty' =>'required',
            'harga' =>'required',
            'supplier' => 'required'
        ]);

        $paket = barang::create([
            'nama_barang' => $request->nama_barang,
            'waktu_beli' => $request->waktu_beli,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'supplier' => $request->supplier
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
            'waktu_beli' => 'required',
            'qty' =>'required',
            'harga' =>'required',
            'supplier' => 'required'
        ]);

        $paket = Barang::findOrFail($id);
        $paket ->update([
            'nama_barang' => $request->nama_barang,
            'waktu_beli' => $request->waktu_beli,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'supplier' => $request->supplier
        ]);
        return redirect('admin/barang')->with('edited','edited');
    }

    public function updateStatus(Request $request){
        $data = Barang::where('id',$request->id)->first();
        $data->status = $request->status;
        $data->update_status = now();
        $update = $data->save();

        if($update){
            $msg = $data->status=="selesai"?"Status Telah DiUpdate":"Status Telah DiUpdate";
            $updateStatus = date('Y-m-d h:i:s', strtotime($data->update_status));
            return response()->json(['msg'=>$msg, 'statusUpdate' => $updateStatus],200);
        }      
    }

    public function exportExcel(){
        return Excel::download(new BarangExport, 'DataBarang.xlsx');
    }

    public function importExcel(Request $request){
        $request->validate([
            'file_import' => 'required|file|mimes:xlsx'
        ]);

        Excel::import(new BarangImport,$request->file('file_import'));

        return redirect()->back();
    }
    //Mendownload Template import excel
    public function templateExcel(){
        return Storage::download('template/Template_Barang.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Barang = Barang::findOrFail($id);
            $Barang->delete();
            return redirect('admin/barang');
    }
}
