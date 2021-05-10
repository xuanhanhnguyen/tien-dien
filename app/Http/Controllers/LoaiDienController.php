<?php
namespace App\Http\Controllers;

use App\LoaiDien;
use Illuminate\Http\Request;

class LoaiDienController extends Controller
{
    public function index()
    {
        $loaidien = LoaiDien::get();
        return view('admin.loaidien.index')->with('loaidien', $loaidien);
    }
    
    public function show($id)
    {
        $loaidien = LoaiDien::where('ma_loai_dien', $id)->firstOrFail();

        return view('admin.loaidien.show')->with('loaidien', $loaidien);
    }

    public function edit($id)
    {
        $loaidien = LoaiDien::where('ma_loai_dien', $id)->firstOrFail();

        return view('admin.loaidien.edit')->with('loaidien', $loaidien);
    }

    public function update(Request $request, $id)
    {
        $loaidien = LoaiDien::where('ma_loai_dien', $id)->firstOrFail();

        $loaidien->ten_loai_dien = $request['tenloaidien'];
        $loaidien->save();

        $loaidien = LoaiDien::get();
        return view('admin.loaidien.index')->with('loaidien', $loaidien);
    }

    public function store(Request $request)
    {

        $loaidien = new LoaiDien();

        $loaidien->ten_loai_dien = $request['tenloaidien'];
        $loaidien->save();
        
        $loaidien = LoaiDien::get();
        return view('admin.loaidien.index')->with('loaidien', $loaidien);
    }

    public function destroy($id)
    {
        $user = LoaiDien::where('ma_loai_dien', $id)->firstOrFail();
        $user->delete();
        // flash('User Deleted')->success();

        return redirect()->back();
    }
}
