<?php

namespace App\Http\Controllers;

use App\KhuVuc;
use Illuminate\Http\Request;

class KhuVucController extends Controller
{
    public function index()
    {
        $khu_vuc = KhuVuc::all();
        return view('admin.khu-vuc.index', compact('khu_vuc'));
    }

    public function edit($id)
    {
        $khu_vuc = KhuVuc::findOrFail($id);
        return view('admin.khu-vuc.edit', compact('khu_vuc'));
    }

    public function store(Request $request)
    {
        try {
            KhuVuc::create($request->all());

            return redirect()->route('khu-vuc.index')->with('message', 'Thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->route('khu-vuc.index')->with('error', 'Thêm thất bại, vui lòng thử lại!');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            KhuVuc::findOrFail($id)->update($request->all());

            return redirect()->route('khu-vuc.index')->with('message', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->route('khu-vuc.index')->with('error', 'Cập nhật thất bại, vui lòng thử lại!');
        }
    }

    public function destroy($id)
    {
        try {
            $kv = KhuVuc::findOrFail($id);

            if ($kv->use->count() > 0) {
                return redirect()->route('khu-vuc.index')->with('error', 'Xóa thất bại, khu vực đang được sủ dụng!');
            }

            KhuVuc::findOrFail($id)->delete();

            return redirect()->route('khu-vuc.index')->with('message', 'Xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('khu-vuc.index')->with('error', 'Xóa thất bại, vui lòng thử lại!');
        }
    }
}