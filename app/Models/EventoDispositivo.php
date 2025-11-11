<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoDispositivo extends Model
{
    protected $table = 'evento_dispositivos';
    protected $fillable = ['evento', 'topico', 'carga'];
    protected $casts = [
        'carga' => 'array',
    ];
}
