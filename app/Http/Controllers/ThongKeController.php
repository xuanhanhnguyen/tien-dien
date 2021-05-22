<?php

namespace App\Http\Controllers;

use App\DKSDDien;
use App\HoaDon;
use App\User;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    public function index()
    {
        $month = \request()->thang ?? $month = date('m');
        $year = \request()->nam ?? date('Y');

        $hd = HoaDon::with([])->selectRaw('trang_thai, count(*) as total')->whereDate($month, $year)->groupBy('trang_thai')->get();
        $data = [];
        foreach (HoaDon::STATUS as $key => $item) {
            $data[$key]['label'] = $item;
            $data[$key]['total'] = 0;
        }

        foreach ($hd as $item) {
            $data[$item->trang_thai]['total'] = $item->total;
        }

        $label = implode(',', array_column($data, 'label'));
        $total = implode(',', array_column($data, 'total'));

        return view('admin.thong-ke.index', compact('label', 'total'));
    }

    public function khachHang()
    {
        $dksd = DKSDDien::with('mcd')->where('ma_khach_hang', \Auth::id())->get();

        $year = \request()->nam ?? date('Y');
        $dksd_id = \request()->dksd_id ?? $dksd[0]['ma_dksd_dien'];

        $data = [];
        for ($i = 1; $i < 13; $i++) {
            $data[$i]['label'] = "Tháng " . $i;
            $data[$i]['total'] = 0;
        }

        $check = DKSDDien::with('mcd')->find($dksd_id);

        if ($check->mcd->loai_gia == 2) {
            $hd = HoaDon::with([])->selectRaw('chi_so_moi, chi_so_cu, thang')
                ->where('nam', $year)
                ->where('ma_dksd_dien', $dksd_id)
                ->where('trang_thai', '>=', 2)
                ->get();
            foreach ($hd as $item) {
                $chi_so_moi = json_decode($item->chi_so_moi);
                $chi_so_cu = json_decode($item->chi_so_cu);
                $total = ($chi_so_moi->binh_thuong - $chi_so_cu->binh_thuong) + $chi_so_moi->cao_diem - $chi_so_cu->cao_diem + $chi_so_moi->thap_diem - $chi_so_cu->thap_diem;

                $data[$item->thang]['total'] = $total;

            }

        } else {
            $hd = HoaDon::with([])->selectRaw('chi_so_moi - chi_so_cu as "total", thang')
                ->where('nam', $year)
                ->where('ma_dksd_dien', $dksd_id)
                ->where('trang_thai', '>=', 2)
                ->get();

            foreach ($hd as $item) {
                $data[$item->thang]['total'] = $item->total;
            }
        }

        $label = implode(',', array_column($data, 'label'));
        $total = implode(',', array_column($data, 'total'));

        return view('admin.thong-ke.kh', compact('label', 'total', 'dksd', 'dksd_id'));
    }
}