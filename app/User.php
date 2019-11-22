<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyApiEmail;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasPushSubscriptions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'negeri', 'email_verified_at'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendApiEmailVerificationNotification(){
        $this->notify(new VerifyApiEmail); // my notification
    }

    public function role() {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }
    
    public function produk() {
        $model = $this->hasMany('App\Produk', 'user_id')->get();
        $result = null;
        // if (count($model) > 0) {
        //     $result = $model->where('tgl_request_sert', null)->first();
        // }
        return $model->first();
    }

    public function produk_client() {
        $model = $this->hasMany('App\Produk', 'user_id')->get();
        return $model;
    }

    public function id_produk() {
        $produk = $this->produk();
        $result = null;
        if (!is_null($produk)) {
            $result = $produk->id;
        }
        return $result;
    }

    public function hasAnyRoles($roles) {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role) {
        if ($this->role()->where('role',$role)->first()) {
            return true;
        }
        return false;
    }

    public function home() {
        $role = \Auth::user()->role()->first()->role;
        if ($role == 'client') {return '/sa';} 
        elseif ($role == 'pemasaran' || $role == 'kerjasama' || $role == 'kabidpjt' || $role == 'keuangan' || $role == 'sertifikasi' || $role == 'kabidpaskal' || $role == 'auditor' || $role == 'tim_teknis' || $role == 'komite_timTeknis' || $role == 'subag_umum') {return '/company';}
    }
}
