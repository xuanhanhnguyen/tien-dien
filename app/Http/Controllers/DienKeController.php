<?php
namespace App\Http\Controllers;

use App\LoaiDien;
use App\GiaDien;
use App\DienKe;
use App\HoaDon;
use App\ChiTietHoaDon;
use App\User;
use Illuminate\Http\Request;

class DienKeController extends Controller
{
    public function index()
    {
        $loaidien = LoaiDien::get();
        $users = User::with('loaidien')->where('role','Khách Hàng')->get();
        $dienke = DienKe::with('loaidien')->get();
        return view('admin.dienke.index')->with(['dienke' => $dienke, 'loaidien' => $loaidien, 'users' => $users]);
    }
    
    public function show($id)
    {
        $dienke = DienKe::where('ma_dien_ke', $id)->firstOrFail();

        return view('admin.dienke.show')->with('dienke', $dienke);
    }

    public function edit($id)
    {
        $loaidien = LoaiDien::get();
        $users = User::with('loaidien')->where('role','Khách Hàng')->get();
        $dienke = DienKe::where('ma_dien_ke', $id)->firstOrFail();

        return view('admin.dienke.edit')->with(['loaidien' => $loaidien, 'dienke' => $dienke, 'users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $dienke = DienKe::where('ma_dien_ke', $id)->firstOrFail();

        $dienke->chi_so_cu = $request['chisocu'];
        $dienke->chi_so_moi = $request['chisomoi'];
        $dienke->ma_khach_hang = $request['makhachhang'];
        $dienke->ma_loai_dien = $request['maloaidien'];
        $dienke->so_cong_to = $request['socongto'];
        $dienke->save();

        $number = (int)$request['chisomoi'] - (int)$request['chisocu'];
        $count = 0;

        $hoadon = $dienke->hoadon;
        $cthoadon = $hoadon->chitiethd;
        foreach($cthoadon as $ct){
            $ct->delete();
        }
        $hoadon->ma_dien_ke = $dienke->ma_dien_ke;
        $hoadon->tong_dien_ke = $number;
        
        $giadien = GiaDien::where('ma_loai_dien', $request['maloaidien'])->where('tu_so', '<', $number)->orderBy('tu_so')->get();

        foreach($giadien as $gd){
            $so_dien = (int)$gd->den_so - (int)$gd->tu_so;
            $dem_so_dien = $number - $so_dien;
            if($dem_so_dien < 0){
                $count += (int)$gd->gia_dien * $number;
            }
            if($dem_so_dien > 0){
                $count += (int)$gd->gia_dien * $so_dien;
            }
            $number = $number - $so_dien;
            if($number < 0){
                break;
            }
        }

        $hoadon->tong_tien = $count;
        $hoadon->save();
        
        $number = (int)$request['chisomoi'] - (int)$request['chisocu'];
        $count = 0;
        
        $giadien = GiaDien::where('ma_loai_dien', $request['maloaidien'])->where('tu_so', '<', $number)->orderBy('tu_so')->get();

        foreach($giadien as $gd){
            $so_dien = (int)$gd->den_so - (int)$gd->tu_so;
            $dem_so_dien = $number - $so_dien;
            if($dem_so_dien > 0){
                $count += (int)$gd->gia_dien * $so_dien;
                $cthoadon = new ChiTietHoaDon();
                $cthoadon->ma_hoa_don = $hoadon->ma_hoa_don;
                $cthoadon->so_dien = $so_dien;
                $cthoadon->don_gia = (int)$gd->gia_dien;
                $cthoadon->tien = (int)$gd->gia_dien * $so_dien;
                $cthoadon->save();
            }
            if($dem_so_dien < 0){
                $count += (int)$gd->gia_dien * $number;
                $cthoadon = new ChiTietHoaDon();
                $cthoadon->ma_hoa_don = $hoadon->ma_hoa_don;
                $cthoadon->so_dien = $number;
                $cthoadon->don_gia = (int)$gd->gia_dien;
                $cthoadon->tien = (int)$gd->gia_dien * $number;
                $cthoadon->save();
            }
            $number = $number - $so_dien;
            if($number < 0){
                break;
            }
        }

        return redirect()->route('dienke.index');
    }

    public function store(Request $request)
    {

        $dienke = new DienKe();

        $dienke->chi_so_cu = $request['chisocu'];
        $dienke->chi_so_moi = $request['chisomoi'];
        $dienke->ma_khach_hang = $request['makhachhang'];
        $dienke->ma_loai_dien = $request['maloaidien'];
        $dienke->so_cong_to = $request['socongto'];
        $dienke->save();

        $number = (int)$request['chisomoi'] - (int)$request['chisocu'];
        $count = 0;

        $hoadon = new HoaDon();
        $hoadon->ma_dien_ke = $dienke->ma_dien_ke;
        $hoadon->tong_dien_ke = $number;

        
        $giadien = GiaDien::where('ma_loai_dien', $request['maloaidien'])->where('tu_so', '<', $number)->orderBy('tu_so')->get();

        foreach($giadien as $gd){
            $so_dien = (int)$gd->den_so - (int)$gd->tu_so;
            $dem_so_dien = $number - $so_dien;
            if($dem_so_dien < 0){
                $count += (int)$gd->gia_dien * $number;
            }
            if($dem_so_dien > 0){
                $count += (int)$gd->gia_dien * $so_dien;
            }
            $number = $number - $so_dien;
            if($number < 0){
                break;
            }
        }

        $hoadon->tong_tien = $count;
        $hoadon->save();
        
        $number = (int)$request['chisomoi'] - (int)$request['chisocu'];
        $count = 0;
        
        $giadien = GiaDien::where('ma_loai_dien', $request['maloaidien'])->where('tu_so', '<', $number)->orderBy('tu_so')->get();

        foreach($giadien as $gd){
            $so_dien = (int)$gd->den_so - (int)$gd->tu_so;
            $dem_so_dien = $number - $so_dien;
            if($dem_so_dien > 0){
                $count += (int)$gd->gia_dien * $so_dien;
                $cthoadon = new ChiTietHoaDon();
                $cthoadon->ma_hoa_don = $hoadon->ma_hoa_don;
                $cthoadon->so_dien = $so_dien;
                $cthoadon->don_gia = (int)$gd->gia_dien;
                $cthoadon->tien = (int)$gd->gia_dien * $so_dien;
                $cthoadon->save();
            }
            if($dem_so_dien < 0){
                $count += (int)$gd->gia_dien * $number;
                $cthoadon = new ChiTietHoaDon();
                $cthoadon->ma_hoa_don = $hoadon->ma_hoa_don;
                $cthoadon->so_dien = $number;
                $cthoadon->don_gia = (int)$gd->gia_dien;
                $cthoadon->tien = (int)$gd->gia_dien * $number;
                $cthoadon->save();
            }
            $number = $number - $so_dien;
            if($number < 0){
                break;
            }
        }

        return redirect()->route('dienke.index');
    }

    public function destroy($id)
    {
        $dienke = DienKe::where('ma_dien_ke', $id)->firstOrFail();
        $hoadon = $dienke->hoadon;
        if(!empty($hoadon)){
            $cthoadon = $hoadon->chitiethd;

            foreach($cthoadon as $ct){
                $ct->delete();
            }
            $hoadon->delete();
        }
        $dienke->delete();
        // flash('User Deleted')->success();

        return redirect()->route('dienke.index');
    }
}
