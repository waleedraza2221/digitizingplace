<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingInfo extends Model
{
    //
    protected $fillable = [
        'name','phone', 'email','address1','address2','postalcode','city','state','country','user_id'
     ];
     
     public function User()
     {
         return $this->belongsTo(User::class);
     }
}
