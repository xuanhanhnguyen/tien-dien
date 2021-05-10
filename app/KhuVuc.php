<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhuVuc extends Model
{
    protected $table = 'khu_vuc';

    protected $fillable = ['ten_khu_vuc', 'don_vi'];
    protected $dates = ['created_at', 'updated_at'];

    protected $primaryKey = 'ma_khu_vuc';

    public function use()
    {
        return $this->hasMany(DKSDDien::class, 'ma_khu_vuc', 'ma_khu_vuc');
    }
}