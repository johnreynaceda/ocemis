<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingSponsor extends Model
{
    protected $guarded = [];

    public function weddingInfo(){
        return $this->belongsTo(WeddingInfo::class);
    }
}
