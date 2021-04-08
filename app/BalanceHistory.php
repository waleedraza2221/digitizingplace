<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class BalanceHistory extends Model
{
    //

    protected $fillable = [
       'user_id', 'amount','refid'
    ];
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
