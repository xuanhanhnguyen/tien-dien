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

    public function show()
    {
        $user = User::findOrFail(\Auth::id());
        return view('admin.users.show')->with('user', $user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->firstname = $request['firstname'];
            $user->lastname = $request['lastname'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];
            $user->gender = (int)$request['gender'];
            if ($request->has('_password')) {
                $user->password = bcrypt($request['password']);
            }
            $user->birthday = date('Y-m-d', strtotime($request['birthday']));
            $user->role = $request['role'];

            $user->save();

            flash('message')->success('Cập nhật thành công.');

            return redirect()->back();

        } catch (\Exception $e) {
            flash('error')->error('Cập nhật thất bại, vui lòng kiểm tra lại.');
            return redirect()->back();
        }
    }

    public function create(Request $request)
    {
        try {

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

            flash('message')->success('Thêm mới thành công.');

            return redirect()->back();
        } catch (\Exception $e) {
            flash('error')->error('Thêm mới thất bại, vui lòng kiểm tra lại.');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->use->count() > 0) {
                flash('error')->error('Xóa thất bại, tài khoản đã ĐKSD điện.');
                return redirect()->back();
            }

            $user->delete();

            flash('message')->success('Xóa thành công.');

            return redirect()->back();
        } catch (\Exception $e) {
            flash('error')->error('Xóa thất bại, vui lòng kiểm tra lại.');
            return redirect()->back();
        }
    }
}
