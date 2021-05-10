<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DKSDDien extends Model
{

    const STATUS = ["Ngừng sử dụng", "Đang sử dụng"];

    protected $table = 'dksd_dien';

    protected $fillable = ['ma_khach_hang', 'ma_khu_vuc', 'ma_loai_dien', 'hs_nhan', 'dia_chi', 'trang_thai'];

    protected $primaryKey = 'ma_dksd_dien';

    public function kh()
    {
        return $this->belongsTo(User::class, 'ma_khach_hang', 'id');
    }

    public function loai_dien()
    {
        return $this->belongsTo(LoaiDien::class, 'ma_loai_dien', 'ma_loai_dien');
    }

    public function kv()
    {
        return $this->belongsTo(KhuVuc::class, 'ma_khu_vuc', 'ma_khu_vuc');
    }

    public function hd()
    {
        return $this->hasMany(HoaDon::class, 'ma_dksd_dien', 'ma_dksd_dien');
    }
}