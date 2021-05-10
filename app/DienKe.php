<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DienKe extends Model
{
    protected $table = 'dien_ke';

    protected $dates = ['created_at', 'updated_at'];

    protected $primaryKey = 'ma_dien_ke';

    /**
     * @return mixed
     */
    public function loaidien()
    {
        return $this->belongsTo('App\LoaiDien','ma_loai_dien','ma_loai_dien');
    }

    /**
     * @return mixed
     */
    public function khachhang()
    {
        return $this->belongsTo('App\User','ma_khach_hang');
    }

        /**
     * @return mixed
     */
    public function hoadon()
    {
        return $this->hasOne('App\HoaDon','ma_dien_ke');
    }
}