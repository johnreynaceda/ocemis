<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function weddingInfo(){
        return $this->hasOne(WeddingInfo::class);
    }

    public function billing(){
        return $this->hasOne(Billing::class);
    }

    public function baptismalInfo(){
        return $this->hasOne(BaptismalInfo::class);
    }

    public function fellowShipInfo(){
        return $this->hasOne(FellowShipInfo::class);
    }
}
