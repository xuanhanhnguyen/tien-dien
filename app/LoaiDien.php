<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiDien extends Model
{
    protected $table = 'loai_dien';

    protected $dates = ['created_at', 'updated_at'];

    protected $primaryKey = 'ma_loai_dien';

    // /**
    //  * @return mixed
    //  */
    // public function loaidien()
    // {
    //     return $this->belongsTo('App\LoaiDien','ma_gia_dien','ma_loai_dien');
    // }

    /**
     * @return mixed
     */
    public function giadien()
    {
        return $this->hasMany('App\GiaDien','ma_loai_dien', 'ma_loai_dien');
    }
}