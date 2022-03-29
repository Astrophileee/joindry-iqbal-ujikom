<?php

namespace App\Http\Controllers;

use App\Exports\MemberExport;
use App\Imports\MemberImport;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.member.index',[
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
            'alamat' =>'required',
            'jenis_kelamin' =>'required'
        ]);

        $Member = Member::create([
            'nama' => $request->nama,
            'tlp' => $request->tlp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);
        return redirect('admin/member')->with('success','success');
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
            'alamat' =>'required',
            'jenis_kelamin' =>'required'
        ]);

        $Member = Member::findOrFail($id);
        $Member ->update([
            'nama' => $request->nama,
            'tlp' => $request->tlp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);
        return redirect('admin/member')->with('edited','edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Member = Member::findOrFail($id);
            $Member->delete();
            return redirect('admin/member');
    }

    public function exportExcel(){
        return Excel::download(new MemberExport, 'DataMember.xlsx');
    }

    public function importExcel(Request $request){
        $request->validate([
            'file_import' => 'required|file|mimes:xlsx'
        ]);

        Excel::import(new MemberImport,$request->file('file_import'));

        return redirect()->back();
    }

    public function templateExcel(){
        return Storage::download('template/Template_Member.xlsx');
    }

    public function dataMember(){

        $data = Member::all();
        return $data;
    }
    //menyimpan data penjemputan ke file pdf
    public function exportMemberPDF()
    {
        $data = $this->DataMember();
        $pdf  = Pdf::loadView('admin.member.pdf', compact('data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-member.pdf');
    }
}
