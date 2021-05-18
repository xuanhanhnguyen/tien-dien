<?php

namespace App;

use App\Http\Controllers\GiaDienController;
use Illuminate\Database\Eloquent\Model;

class MucCapDien extends Model
{

    const GIA = ["Giá cụ thể", "Chỉ số kwh", "Khung giờ", "Cấp điện áp"];

    protected $table = 'muc_cap_dien';

    protected $primaryKey = 'ma_muc_cap_dien';

    protected $fillable = ['ten_muc_cap_dien', 'ma_loai_dien', 'loai_gia'];

    /**
     * @return mixed
     */
    public function loaidien()
    {
        return $this->belongsTo('App\LoaiDien', 'ma_loai_dien', 'ma_loai_dien');
    }

    /**
     * @return mixed
     */
    public function giadien()
    {
        return $this->hasMany(GiaDien::class, 'ma_muc_cap_dien', 'ma_muc_cap_dien');
    }
}