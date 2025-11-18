<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Huella extends Model
{
    protected $fillable = [
        'dispositivo_id',
        'finger_id',
    ];

    public function dispositivo()
    {
        return $this->belongsTo(Dispositivo::class);
    }
}

