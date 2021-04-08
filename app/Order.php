<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'design_id', 'status','description','amount','refno','paid_by','paid_on'
    ];
    
    public function Design()
    {
        return $this->belongsTo('App\Design');
    }
  
}