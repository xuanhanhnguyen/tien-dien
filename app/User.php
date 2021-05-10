<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $dates = ['birthday'];
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'facebook_id', 'google_id', 'github_id', 'phone', 'gender', 'firstname', 'lastname', 'email', 'role'
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

    public static function login($request)
    {
        $remember = $request->remember;
        $email = $request->email;
        $password = $request->password;
        return (\Auth::attempt(['email' => $email, 'password' => $password], $remember));
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
}
