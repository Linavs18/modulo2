<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    protected $table = 'artista';
    protected $fillable = [
        'nombre',
        'genero',
        'ciudad_origen'
    ];

    public function eventos()
    {
        return $this ->hasMany(Evento:: class);
    }
}
