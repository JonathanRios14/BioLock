<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'codigo_unico',
    ];

    /**
     * Relación inversa con User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function huellas()
    {
        return $this->hasMany(Huella::class);
    }

}
