<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phuong extends Model
{
    protected $table = 'phuong';

    protected $dates = ['created_at', 'updated_at'];

    protected $primaryKey = 'ma_phuong';

    /**
     * @return mixed
     */
    public function khuvuc()
    {
        return $this->hasMany('App\KhuVuc','ma_phuong', 'ma_phuong');
    }
}