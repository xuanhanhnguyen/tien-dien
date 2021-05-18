<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    const ROLE = ['Admin', 'Nhân viên', 'Khách hàng'];
    protected $dates = ['birthday'];
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'address', 'phone', 'gender', 'firstname', 'lastname', 'email', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function isAdmin()
    {
        return ($this->role == 'admin' || $this->role == 'Admin');
    }

    public function isStaff()
    {
        return ($this->role == 'Nhân Viên');
    }

    public function isCustomer()
    {
        return ($this->role == User::ROLE[2]);
    }

    public static function login($request)
    {
        $remember = $request->remember;
        $username = $request->username;
        $password = $request->password;
        return (\Auth::attempt(['username' => $username, 'password' => $password], $remember));
    }

    public function loaidien()
    {
        return $this->belongsTo('App\LoaiDien', 'ma_loai_dien');
    }

    public function khuvuc()
    {
        return $this->belongsTo('App\KhuVuc', 'ma_khu_vuc', 'ma_khu_vuc');
    }

    /**
     * @return mixed
     */
    public function dienke()
    {
        return $this->hasOne('App\DienKe', 'ma_khach_hang');
    }

    public function use()
    {
        return $this->hasMany(DKSDDien::class, 'ma_khach_hang', 'id');
    }
}
