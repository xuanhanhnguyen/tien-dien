<?php

namespace App\Http\Controllers;

use App\DKSDDien;
use App\HoaDon;
use App\KhuVuc;
use App\LoaiDien;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    public function index()
    {
        if (\Auth::user()->role == User::ROLE[0]) {
            if (\request()->id) {
                $hd = HoaDon::has('isCustomer')->with('ho_so', 'ho_so.kh', 'ho_so.kv', 'ho_so.mcd', 'ho_so.mcd.giadien')->get();
            } else {
                $hd = HoaDon::with('ho_so', 'ho_so.kh', 'ho_so.kv', 'ho_so.mcd', 'ho_so.mcd.giadien')->get();
            }
            $hs = DKSDDien::with('kh')->get();
        } else if (\Auth::user()->role == User::ROLE[1]) {
            $hd = HoaDon::with('ho_so', 'ho_so.kh', 'ho_so.kv', 'ho_so.mcd')->whereIn('trang_thai', [1, 2])->get();
            $hs = DKSDDien::with('kh')->get();
        } else {
            $hd = HoaDon::has('isCustomer')->with('ho_so', 'ho_so.kh', 'ho_so.kv', 'ho_so.mcd')->get();
            $hs = DKSDDien::with('kh')->get();
        }

        return view('admin.hoa-don.index', compact('hd', 'hs'));
    }

    public function show($id)
    {
        $hd = HoaDon::with('ho_so', 'ho_so.kh', 'ho_so.kv', 'ho_so.mcd', 'ho_so.mcd.giadien')->find($id);

//        $pdf = PDF::loadView('admin.hoa-don.print', compact('hd'));
//        return $pdf->download('invoice.pdf');
        return view('admin.hoa-don.print', compact('hd'));
    }

    public function create()
    {
        $hs = (object)['ma_dksd_dien' => ""];
        if (\request()->id) {
            $hs = DKSDDien::with('kh', 'mcd')->find(\request()->id);
        }

        $dksd = DKSDDien::all();

        return view('admin.hoa-don.add', compact('hs', 'dksd'));
    }

    public function edit($id)
    {
        $hd = HoaDon::with('ho_so', 'ho_so.kh', 'ho_so.mcd')->findOrFail($id);
        if ($hd->ho_so->mcd->loai_gia == 2) {
            $hd->chi_so_cu = json_decode($hd->chi_so_cu);
            $hd->chi_so_moi = json_decode($hd->chi_so_moi);
        }

        return view('admin.hoa-don.edit', compact('hd'));
    }

    public function store(Request $request)
    {
        try {
            $data = collect($request->all())->merge([
                "chi_so_cu" => is_array($request->chi_so_cu) ? json_encode($request->chi_so_cu) : $request->chi_so_cu,
                "chi_so_moi" => is_array($request->chi_so_moi) ? json_encode($request->chi_so_moi) : $request->chi_so_moi,
            ])->toArray();
            HoaDon::create($data);

            return redirect()->route('hoa-don.index')->with('message', 'Thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->route('hoa-don.index')->with('error', 'Thêm thất bại, vui lòng thử lại!');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = collect($request->all())->merge([
                "chi_so_cu" => is_array($request->chi_so_cu) ? json_encode($request->chi_so_cu) : $request->chi_so_cu,
                "chi_so_moi" => is_array($request->chi_so_moi) ? json_encode($request->chi_so_moi) : $request->chi_so_moi,
            ])->toArray();

            HoaDon::findOrFail($id)->update($data);

            return redirect()->route('hoa-don.index')->with('message', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->route('hoa-don.index')->with('error', 'Cập nhật thất bại, vui lòng thử lại!');
        }
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