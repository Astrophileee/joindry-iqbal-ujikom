<?php

namespace App\Http\Controllers;

use App\Exports\OutletExport;
use App\Imports\OutletImport;
use App\Models\Outlet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.outlet.index',[
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
            'nama' => 'required',
            'tlp' =>'required|min:10|max:12',
            'alamat' =>'required'
        ]);

        $outlets = Outlet::create([
            'nama' => $request->nama,
            'tlp' => $request->tlp,
            'alamat' => $request->alamat
        ]);
        return redirect('admin/outlet')->with('success','success');
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
            'nama' => 'required',
            'tlp' =>'required|min:10|max:12',
            'alamat' =>'required'
        ]);

        $outlet = Outlet::findOrFail($id);
        $outlet ->update([
            'nama' => $request->nama,
            'tlp' => $request->tlp,
            'alamat' => $request->alamat
        ]);
        return redirect('admin/outlet')->with('edited','edited');
    }

    public function exportExcel(){
        return Excel::download(new OutletExport, 'DataOutlet.xlsx');
    }

    public function importExcel(Request $request){
        $request->validate([
            'file_import' => 'required|file|mimes:xlsx'
        ]);

        Excel::import(new OutletImport,$request->file('file_import'));

        return redirect()->back();
    }

    public function templateExcel(){
        return Storage::download('template/Template_Outlet.xlsx');
    }

    public function dataOutlet(){

        $data = Outlet::all();
        return $data;
    }
    //menyimpan data penjemputan ke file pdf
    public function exportOutletPDF()
    {
        $data = $this->DataOutlet();
        $pdf  = Pdf::loadView('admin.outlet.pdf', compact('data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-outlet.pdf');
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $outlet = Outlet::findOrFail($id);
            $outlet->delete();
            return redirect('admin/outlet');
    }
}
