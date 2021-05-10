<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    protected $table = 'chi_tiet_hoa_don';

    protected $dates = ['created_at', 'updated_at'];

    protected $primaryKey = 'ma_ct_hoa_don';

    // /**
    //  * @return mixed
    //  */
    // public function loaidien()
    // {
    //     return $this->belongsTo('App\LoaiDien','ma_gia_dien','ma_loai_dien');
    // }
}