<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('roles', 'SKPD')->get();
        return view('Admin.user.index', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'email' => 'unique:users,email'
            ],
            [
                'email.unique' => 'Email Sudah Terdaftar'
            ]
        );
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->skpd_id = $request->skpd_id;
        $data->password = bcrypt($request->password);

        $data->save();

        if ($data != null) {
            return redirect()->route('admin.user.index')->with('success', 'Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.user.index')->with('error', 'Data Gagal di Tambah');
        }
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $data->name = $request->name;
        $data->skpd_id = $request->skpd_id;

        $data->save();

        if ($data != null) {
            return redirect()->route('admin.user.index')->with('success', 'Data Berhasil di Update');
        } else {
            return redirect()->route('admin.user.index')->with('error', 'Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = User::findOrFail($id);

        if ($data != null) {
            $data->delete();
            return redirect()->route('admin.user.index')->with('success', 'Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.user.index')->with('error', 'Data Gagal di Hapus');
        }
    }
}
