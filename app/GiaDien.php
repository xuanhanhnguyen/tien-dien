<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaDien extends Model
{
    protected $table = 'gia_dien';

    protected $dates = ['created_at', 'updated_at'];

    protected $primaryKey = 'ma_gia_dien';

    /**
     * @return mixed
     */
    public function loaidien()
    {
        return $this->belongsTo('App\LoaiDien','ma_loai_dien','ma_loai_dien');
    }
}