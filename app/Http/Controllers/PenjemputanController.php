<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Penjemputan;
use Illuminate\Http\Request;
use App\Exports\PenjemputanExport;
use App\Imports\Penjemputanimport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PenjemputanController extends Controller
{
    /**
     * Menampilkan Halaman Penjemputan
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.penjemputan.index',[
            'penjemputan' => Penjemputan::All(),
            'member' => Member::all()
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
     * Menyimpan Data Penjemputan di database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_member' =>'required',
            'petugas' =>'required'
        ]);

        $paket = Penjemputan::create([
            'id_member' => $request->id_member,
            'petugas' => $request->petugas
        ]);
        return redirect('admin/penjemputan')->with('success','success');
    }

    public function updateStatus(Request $request){
        $data = Penjemputan::where('id',$request->id)->first();
        $data->status = $request->status;
        $update = $data->save();

        if($update){
            $msg = $data->status=="selesai"?"Penjemputan Berhasil":"Sedang Dijemputapp";
            return response()->json(['msg'=>$msg],200);
        }      
    }

    //menyimpan data penjemputan ke file excel
    public function exportExcel(){
        return Excel::download(new PenjemputanExport, 'DataPenjemputan.xlsx');
    }
    //mengimport data penjemputan dari file excel
    public function importExcel(Request $request){
        $request->validate([
            'file_import' => 'required|file|mimes:xlsx'
        ]);

        Excel::import(new Penjemputanimport,$request->file('file_import'));

        return redirect()->back();
    }
    //Mendownload Template import excel
    public function templateExcel(){
        return Storage::download('template/Template_penjemputan.xlsx');
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
     * Mengupdate data penjemputan di database
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_member' =>'required',
            'petugas' =>'required'
        ]);


        $penjemputan = Penjemputan::findOrFail($id);
        $penjemputan ->update([
            'id_member' => $request->id_member,
            'petugas' => $request->petugas
        ]);
        return redirect('admin/penjemputan')->with('edited','edited');
    }

    /**
     * menghapus data penjemputan didatabase
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penjemputan = Penjemputan::findOrFail($id);
            $penjemputan->delete();
            return redirect('admin/penjemputan');
    }
}
