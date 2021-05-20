<?php

namespace App\Http\Controllers;

use App\DKSDDien;
use App\HoaDon;
use App\User;
use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    public function index()
    {
        $month = \request()->thang ?? $month = date('m');
        $year = \request()->nam ?? date('Y');

        if (\Auth::user()->role == User::ROLE[0]) {
            if (\request()->id) {
                $hd = HoaDon::has('isCustomer')->with('ho_so', 'ho_so.kh', 'ho_so.kv', 'ho_so.mcd', 'ho_so.mcd.giadien')->whereDate($month, $year)->get();
            } else {
                $hd = HoaDon::with('ho_so', 'ho_so.kh', 'ho_so.kv', 'ho_so.mcd', 'ho_so.mcd.giadien')->whereDate($month, $year)->get();
            }
            $hs = DKSDDien::with('kh')->get();
        } else if (\Auth::user()->role == User::ROLE[1]) {
            $hd = HoaDon::with('ho_so', 'ho_so.kh', 'ho_so.kv', 'ho_so.mcd')->whereIn('trang_thai', [1, 2])->whereDate($month, $year)->get();
            $hs = DKSDDien::with('kh')->get();
        } else {
            $hd = HoaDon::has('isCustomer')->with('ho_so', 'ho_so.kh', 'ho_so.kv', 'ho_so.mcd')->whereDate($month, $year)->get();
            $hs = DKSDDien::with('kh')->get();
        }

        $checkAuto = HoaDon::with([])->whereDate($month, $year)->where('auto', 1)->count();

        return view('admin.hoa-don.index', compact('hd', 'hs', 'checkAuto'));
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

    public function createAuto(Request $request)
    {
        try {

            if ($request->has('_update')) {
                $hs = DKSDDien::with('mcd')->where('trang_thai', 1)->get();
            } else {
                $hs = DKSDDien::doesntHave('existHD')->with('mcd')->where('trang_thai', 1)->get();
            }

            foreach ($hs as $item) {

                $hd = HoaDon::where('ma_dksd_dien', $item->ma_dksd_dien)->latest()->first();

                if ($hd) {
                    $_chi_so_cu = $hd->chi_so_moi;
                }

                $data = collect($request->all())->merge([
                    'ma_dksd_dien' => $item->ma_dksd_dien,
                    'tu_ngay' => $request->tu_ngay . '/' . ($request->thang - 1) . '/' . $request->nam,
                    'den_ngay' => $request->den_ngay . '/' . ($request->thang) . '/' . $request->nam,
                    'chi_so_cu' => $_chi_so_cu ?? ($item->mcd->loai_gia == 2 ? '{"binh_thuong":"0","thap_diem":"0","cao_diem":"0"}' : 0),
                    'chi_so_moi' => $item->mcd->loai_gia == 2 ? '{"binh_thuong":"0","thap_diem":"0","cao_diem":"0"}' : 0,
                    'auto' => 1
                ])->toArray();

                HoaDon::updateOrCreate(
                    [
                        'ma_dksd_dien' => $item->ma_dksd_dien,
                        'thang' => $request->thang,
                        'nam' => $request->nam],
                    $data
                );
            }

            flash('message')->success('Thêm thành công.');

            return redirect()->back();
        } catch (\Exception $e) {
            flash('error')->error('Thêm thất bại, vui lòng kiểm tra lại.');
            return redirect()->back();
        }
    }

    public function updateAuto(Request $request)
    {
        try {

            if ($request->has('_update')) {
                $_hs = DKSDDien::doesntHave('existHD')->with('mcd')->where('trang_thai', 1)->get();
            }

            $hs = DKSDDien::has('existHD')->with('mcd')->where('trang_thai', 1)->get();

            foreach ($hs as $item) {

                $data = collect($request->all())->merge([
                    'tu_ngay' => $request->tu_ngay . '/' . ($request->thang - 1) . '/' . $request->nam,
                    'den_ngay' => $request->den_ngay . '/' . ($request->thang) . '/' . $request->nam,
                ])->toArray();

                HoaDon::updateOrCreate(
                    [
                        'ma_dksd_dien' => $item->ma_dksd_dien,
                        'thang' => $request->thang,
                        'nam' => $request->nam],
                    $data
                );
            }

            if (isset($_hs)) {
                foreach ($_hs as $item) {

                    $hd = HoaDon::where('ma_dksd_dien', $item->ma_dksd_dien)->latest()->first();

                    if ($hd) {
                        $_chi_so_cu = $hd->chi_so_moi;
                    }

                    $data = collect($request->all())->merge([
                        'ma_dksd_dien' => $item->ma_dksd_dien,
                        'tu_ngay' => $request->tu_ngay . '/' . ($request->thang - 1) . '/' . $request->nam,
                        'den_ngay' => $request->den_ngay . '/' . ($request->thang) . '/' . $request->nam,
                        'chi_so_cu' => $_chi_so_cu ?? ($item->mcd->loai_gia == 2 ? '{"binh_thuong":"0","thap_diem":"0","cao_diem":"0"}' : 0),
                        'chi_so_moi' => $item->mcd->loai_gia == 2 ? '{"binh_thuong":"0","thap_diem":"0","cao_diem":"0"}' : 0,
                        'auto' => 1
                    ])->toArray();

                    HoaDon::updateOrCreate(
                        [
                            'ma_dksd_dien' => $item->ma_dksd_dien,
                            'thang' => $request->thang,
                            'nam' => $request->nam],
                        $data
                    );
                }
            }

            flash('message')->success('Cập nhật thành công.');

            return redirect()->back();
        } catch (\Exception $e) {
            flash('error')->error('Cập nhật thất bại, vui lòng kiểm tra lại.');
            return redirect()->back();
        }
    }
}