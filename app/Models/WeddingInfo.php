<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingInfo extends Model
{
    protected $guarded = [];

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function weddingSponsor(){
        return $this->hasOne(WeddingSponsor::class);
    }
    
}
