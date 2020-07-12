<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SourceFiles extends Model
{
    //
    protected $fillable = [
        'filename', 'design_id'
    ];

    public function Design()
    {
        return $this->belongsTo('App\Design');
    }
    
}
