<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index',[
            'user' => User::all(),
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
            'id_outlet' => 'required',
            'nama' =>'required',
            'email' =>'required',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
            'role'=>'required'
        ]);
        $password = bcrypt($request->password);
        $user = user::create([
            'id_outlet' => $request->id_outlet,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $password,
            'role' => $request->role
        ]);
        return redirect('admin/user')->with('success','success');
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
            'nama' =>'required',
            'email' =>'required',
            'role'=>'required'
        ]);

        $updateUser = [
            'id_outlet' => $request->id_outlet,
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role
        ];

        if ($request->has('password') && $request->password != ''){
            $request->validate([
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
            ]);
            $updateUser['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user ->update($updateUser);
        return redirect('admin/user')->with('edited','edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::findOrFail($id);
            $User->delete();
            return redirect('admin/user');
    }
}
