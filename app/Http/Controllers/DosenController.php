<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = User::where('level', 'Dosen')->get();
        return view('admin.show_dosen', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_dosen');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'nip_nim.required' => 'NIP tidak boleh kosong.',
            'nip_nim.unique' => 'NIP sudah terpakai.',
            'name.required' => 'Nama tidak boleh kosong.',
            'majors.required' => 'Jurusan tidak boleh kosong.',
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique' => 'Username sudah terpakai.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 8 karakter.',
        ];

        $request->validate([
            'nip_nim' => 'required|unique:users',
            'name' => 'required',
            'majors' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8'
        ], $messages);

        $data = $request->all();
        $data['password'] = \Hash::make($data['password']);
        User::create(array_merge($data, ['level' => 'Dosen']));

        return redirect('/dosen')->with('status', 'Dosen Data Successfully Added!');
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
        $user = User::findOrFail($id);
        return view('admin.edit_dosen', compact('user'));
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
        $data = $request->all();
        $user = User::findOrFail($id);
        $messages = [
            'nip_nim.required' => 'NIP tidak boleh kosong.',
            'nip_nim.unique' => 'NIP sudah terpakai.',
            'name.required' => 'Nama tidak boleh kosong.',
            'majors.required' => 'Jurusan tidak boleh kosong.',
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique' => 'Username sudah terpakai.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 8 karakter.',
        ];

        $request->validate([
            'nip_nim' => 'required|unique:users,nip_nim,' . $id,
            'name' => 'required',
            'majors' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'required|min:8'
        ], $messages);

        
        $data['password'] = \Hash::make($data['password']);
        $user->update(array_merge($data, ['level' => 'Dosen']));
        return redirect('/dosen')->with('status', 'Dosen Data Successfully Changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/dosen')->with('status', 'Dosen Data Successfully Deleted!');
    }
}
