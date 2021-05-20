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

        return view('admin.thong-ke.index', compact('hd'));
    }
}