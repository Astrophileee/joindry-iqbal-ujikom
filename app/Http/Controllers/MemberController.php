<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

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
}
