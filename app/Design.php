<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    //

    protected $fillable = [
        'description', 'isvector', 'user_id', 'status','budget','isdigitizing'
    ];
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function SourceFiles(){

        return $this->hasMany('App\SourceFiles');
    }
  
}
