<?php

namespace App\Http\Controllers;

use App\DKSDDien;
use App\HoaDon;
use App\KhuVuc;
use App\LoaiDien;
use App\User;
use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    public function index()
    {
        $hd = HoaDon::with('ho_so', 'ho_so.kh', 'ho_so.kv', 'ho_so.loai_dien')->get();
        $hs = DKSDDien::with('kh')->get();
        return view('admin.hoa-don.index', compact('hd', 'hs'));
    }

    public function edit($id)
    {
        $hs = DKSDDien::with('kh')->get();
        $hd = HoaDon::findOrFail($id);
        return view('admin.hoa-don.edit', compact('hd', 'hs'));
    }

    public function store(Request $request)
    {
        try {
            HoaDon::create($request->all());

            return redirect()->route('hoa-don.index')->with('message', 'Thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->route('hoa-don.index')->with('error', 'Thêm thất bại, vui lòng thử lại!');
        }
    }

    public function update(Request $request, $id)
    {
//        try {
            HoaDon::findOrFail($id)->update($request->all());

            return redirect()->route('hoa-don.index')->with('message', 'Cập nhật thành công!');
//        } catch (\Exception $e) {
//            return redirect()->route('hoa-don.index')->with('error', 'Cập nhật thất bại, vui lòng thử lại!');
//        }
    }

    public function destroy($id)
    {
        try {
            $kv = HoaDon::findOrFail($id);

            if ($kv->hd->count() > 0) {
                return redirect()->route('hoa-don.index')->with('error', 'Xóa thất bại, hồ sơ đang được sủ dụng!');
            }

            HoaDon::findOrFail($id)->delete();

            return redirect()->route('hoa-don.index')->with('message', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('hoa-don.index')->with('error', 'Xóa thất bại, vui lòng thử lại!');
        }
    }
}