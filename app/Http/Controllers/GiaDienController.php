<?php
namespace App\Http\Controllers;

use App\LoaiDien;
use App\GiaDien;
use Illuminate\Http\Request;

class GiaDienController extends Controller
{
    public function index()
    {
        $loaidien = LoaiDien::with('giadien')->get();
        $giadien = GiaDien::with('loaidien')->get();
        return view('admin.giadien.index')->with(['loaidien' => $loaidien, 'giadien' => $giadien]);
    }
    
    public function show($id)
    {
        $giadien = GiaDien::where('ma_gia_dien', $id)->firstOrFail();

        return view('admin.giadien.show')->with('giadien', $giadien);
    }

    public function edit($id)
    {
        $loaidien = LoaiDien::get();
        $giadien = GiaDien::where('ma_gia_dien', $id)->firstOrFail();

        return view('admin.giadien.edit')->with(['loaidien' => $loaidien, 'giadien' => $giadien]);
    }

    public function update(Request $request, $id)
    {
        $giadien = GiaDien::where('ma_gia_dien', $id)->firstOrFail();
        $giadien->tu_so = $request['tuso'];
        $giadien->den_so = $request['denso'];
        $giadien->gia_dien = $request['giadien'];
        $giadien->ma_loai_dien = (int)$request['maloaidien'];
        $giadien->save();

        return redirect()->route('giadien.index');
    }

    public function store(Request $request)
    {

        $giadien = new GiaDien();

        $giadien->tu_so = $request['tuso'];
        $giadien->den_so = $request['denso'];
        $giadien->gia_dien = $request['giadien'];
        $giadien->ma_loai_dien = (int)$request['maloaidien'];
        $giadien->save();
        return redirect()->route('giadien.index');
    }

    public function destroy($id)
    {
        $user = GiaDien::where('ma_gia_dien', $id)->firstOrFail();
        $user->delete();
        // flash('User Deleted')->success();

        return redirect()->back();
    }
}
