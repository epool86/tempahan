<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Booking extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public function room(){
        return $this->belongsTo('App\Models\Room')->withTrashed();
    }

    public function user(){
        return $this->belongsTo('App\Models\User')->withTrashed();
    }
    
}
