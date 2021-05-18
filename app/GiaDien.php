<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaDien extends Model
{
    protected $table = 'gia_dien';

    protected $dates = ['created_at', 'updated_at'];

    protected $primaryKey = 'ma_gia_dien';

    protected $fillable = ['ma_muc_cap_dien', 'ten_gia_dien', 'tu_so', 'den_so', 'gia_dien', 'cao_diem', 'thap_diem', 'binh_thuong'];

    /**
     * @return mixed
     */
    public function muc_cap_dien()
    {
        return $this->belongsTo(MucCapDien::class, 'ma_muc_cap_dien', 'ma_muc_cap_dien');
    }
}