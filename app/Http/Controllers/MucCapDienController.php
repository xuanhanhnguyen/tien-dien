<?php

namespace App\Http\Controllers;

use App\LoaiDien;
use App\MucCapDien;
use Illuminate\Http\Request;

class MucCapDienController
{
    public function index()
    {
        try {

            $loaidien = LoaiDien::all();
            $ld = \request()->ld ?? $loaidien[0]['ma_loai_dien'];

            $data = MucCapDien::where('ma_loai_dien', $ld)->get();

            return view('admin.muc-cap-dien.index', compact('data', 'loaidien', 'ld'));
        } catch (\Exception $e) {
            flash('error')->error('Vui lòng tạo loại điện');
            return redirect()->route('loaidien.index');
        }
    }

    public function edit($id)
    {
        $loaidien = LoaiDien::all();
        $data = MucCapDien::findOrFail($id);

        return view('admin.muc-cap-dien.edit', compact('data', 'loaidien'));
    }

    public function update(Request $request, $id)
    {
        try {

            MucCapDien::findOrFail($id)->update($request->all());

            flash('message')->success('Cập nhật thành công.');

            return redirect()->route('muc-cap-dien.index');
        } catch (\Exception $e) {
            flash('error')->error('Cập nhật thất bại, vui lòng kiểm tra lại.');
            return redirect()->route('muc-cap-dien.index');
        }
    }

    public function store(Request $request)
    {
        try {

            MucCapDien::create($request->all());

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
            if (MucCapDien::findOrFail($id)->giadien->count() > 0) {
                flash('error')->error('Thất bại, mức điện đang được sử dụng.');
            } else {
                MucCapDien::findOrFail($id)->delete();

                flash('message')->success('Xóa thành công.');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            flash('error')->error('Xóa thất bại, vui lòng kiểm tra lại.');
            return redirect()->back();
        }
    }
}