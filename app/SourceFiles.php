<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SourceFiles extends Model
{
    //

    public function Design()
    {
        return $this->belongsTo('App\Design');
    }
    
}
