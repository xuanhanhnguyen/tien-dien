<?php

namespace App\Http\Controllers;

use App\DKSDDien;
use App\KhuVuc;
use App\LoaiDien;
use App\User;
use Illuminate\Http\Request;

class DKSDDienController extends Controller
{
    public function index()
    {
        $kv = KhuVuc::all();
        $ld = LoaiDien::all();
        $kh = User::where('role', 'Khách hàng')->get();

        $dksd = DKSDDien::with('kv', 'loai_dien', 'kh')->get();
        return view('admin.dksd-dien.index', compact('dksd', 'kv', 'ld', 'kh'));
    }

    public function edit($id)
    {
        $kv = KhuVuc::all();
        $ld = LoaiDien::all();
        $kh = User::where('role', 'Khách hàng')->get();

        $dksd = DKSDDien::findOrFail($id);
        return view('admin.dksd-dien.edit', compact('dksd', 'kv', 'ld', 'kh'));
    }

    public function store(Request $request)
    {
        try {
            DKSDDien::create($request->all());

            return redirect()->route('dksd-dien.index')->with('message', 'Thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->route('dksd-dien.index')->with('error', 'Thêm thất bại, vui lòng thử lại!');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DKSDDien::findOrFail($id)->update($request->all());

            return redirect()->route('dksd-dien.index')->with('message', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->route('dksd-dien.index')->with('error', 'Cập nhật thất bại, vui lòng thử lại!');
        }
    }

    public function destroy($id)
    {
        try {
            $kv = DKSDDien::findOrFail($id);

            if ($kv->hd->count() > 0) {
                return redirect()->route('dksd-dien.index')->with('error', 'Xóa thất bại, hồ sơ đang được sủ dụng!');
            }

            DKSDDien::findOrFail($id)->delete();

            return redirect()->route('dksd-dien.index')->with('message', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('dksd-dien.index')->with('error', 'Xóa thất bại, vui lòng thử lại!');
        }
    }
}