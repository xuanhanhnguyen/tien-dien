<?php

namespace App\Http\Controllers;

use App\User;
use App\LoaiDien;
use App\Phuong;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $loaidien = LoaiDien::get();
        $users = User::with('loaidien')->get();
        return view('admin.users.index')->with(['users' => $users, 'loaidien' => $loaidien]);
    }

    public function getAdmin()
    {
        $users = User::where('role', 'Admin')->get();
        return view('admin.users.listAdmin', compact('users'));
    }

    public function getKhachHang()
    {
        $users = User::where('role', 'Khách hàng')->get();
        return view('admin.users.listKhachHang', compact('users'));
    }

    public function getNhanVien()
    {
        $users = User::where('role', 'Nhân viên')->get();
        return view('admin.users.listNhanVien', compact('users'));
    }

    public function getHoaDon($id)
    {
        $user = User::findOrFail($id);
        $hoadon = $user->dienke()->with('hoadon', 'hoadon.chitiethd')->get();
        return view('admin.users.listHoaDon')->with(['user' => $user, 'hoadon' => $hoadon]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show')->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->username = $request['username'];
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->gender = (int)$request['gender'];
        if (!empty($request['password'])) {
            $user->password = bcrypt($request['password']);
        }
        $user->birthday = date('Y-m-d', strtotime($request['birthday']));
        // $user->role = $request['role'];

        $user->save();
        if ($request['role'] == "Admin") {
            return redirect()->route('admin.user.admin');
        }
        if ($request['role'] == "Khách hàng") {
            return redirect()->route('admin.user.khachhang');
        }
        return redirect()->route('admin.user.nhanvien');
    }

    public function create(Request $request)
    {

        $user = new User();
        $user->username = $request['username'];
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];
        $user->gender = (int)$request['gender'];
        $user->password = bcrypt($request['password']);
        $user->birthday = date('Y-m-d', strtotime($request['birthday']));
        $user->role = $request['role'];
        $user->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // flash('User Deleted')->success();

        return redirect()->back();
    }
}
