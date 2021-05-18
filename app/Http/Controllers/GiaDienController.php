<?php

namespace App\Http\Controllers;

use App\LoaiDien;
use App\GiaDien;
use App\MucCapDien;
use Illuminate\Http\Request;

class GiaDienController extends Controller
{
    public function index()
    {
        try {
            $loaidien = LoaiDien::all();
            $ld = \request()->ld ?? $loaidien[0]['ma_loai_dien'];
            $data = MucCapDien::with('giadien', 'loaidien')->where('ma_loai_dien', $ld)->get();

            return view('admin.giadien.index', compact('data', 'loaidien', 'ld'));
        } catch (\Exception $e) {
            flash('error')->error('Vui lòng tạo loại điện');
            return redirect()->route('loaidien.index');
        }
    }

    public function show($id)
    {
        $giadien = GiaDien::where('ma_gia_dien', $id)->firstOrFail();

        return view('admin.giadien.show')->with('giadien', $giadien);
    }

    public function edit($id)
    {
        $mcd = MucCapDien::all();
        $giadien = GiaDien::find($id);

        $id = \request()->mcd ?? $mcd[0]['ma_muc_cap_dien'];
        $_mcd = MucCapDien::find($id);

        return view('admin.giadien.edit', compact('mcd', 'id', '_mcd', 'giadien'));
    }

    public function update(Request $request, $id)
    {
        try {

            GiaDien::where('ma_gia_dien', $id)->firstOrFail()->update($request->all());

            flash('message')->success('Cập nhật thành công.');

            return redirect()->route('giadien.index');
        } catch (\Exception $e) {
            flash('error')->error('Cập nhật thất bại, vui lòng kiểm tra lại.');
            return redirect()->route('giadien.index');
        }
    }

    public function create()
    {
        $mcd = MucCapDien::all();
        $id = \request()->mcd ?? $mcd[0]['ma_muc_cap_dien'];
        $_mcd = MucCapDien::find($id);
        return view('admin.giadien.add', compact('mcd', 'id', '_mcd'));
    }

    public function store(Request $request)
    {

        try {

            GiaDien::create($request->all());


            flash('message')->success('Thêm mới thành công.');

            return redirect()->route('giadien.index');
        } catch (\Exception $e) {
            flash('error')->error('Thêm mới thất bại, vui lòng kiểm tra lại.');
            return redirect()->route('giadien.index');
        }
    }

    public function destroy($id)
    {
        try {

            $user = GiaDien::where('ma_gia_dien', $id)->firstOrFail();
            $user->delete();


            flash('message')->success('Xóa thành công.');

            return redirect()->back();
        } catch (\Exception $e) {
            flash('error')->error('Xóa thất bại, vui lòng kiểm tra lại.');
            return redirect()->back();
        }
    }
}
