<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\BalanceHistory;
use App\BillingInfo;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone','password', 'role_id','amount','balance'
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

    public function role(){

        return $this->belongsTo(Role::class);
    }

    public function balancehistory()
    {
        return $this->hasMany(BalanceHistory::class);
    }
    public function designs(){

        return $this->hasMany('App\Design');
    }
	
	 public function profile(){
        return $this->hasOne(Profile::class)->withDefault();
    }
    public function BillingInfo(){

        return $this->hasOne(BillingInfo::class)->withDefault();
    }


    public function isAdmin(){
        return strtolower($this->role->name)==='admin';
    }
    public function isClient(){
        return strtolower($this->role->name)==='client';
    }

}
