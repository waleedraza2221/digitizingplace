<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    //


    public function User()
    {
        return $this->belongsTo('App\User');
    }

    protected $dateFormat = 'm.d.Y';
}
