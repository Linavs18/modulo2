<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palco extends Model
{
    use HasFactory;

    protected $table = 'palco';
    protected $fillable = [
        'nombre',
        'cantidad',
        'valor',
        'id_evento',
        'id_localidad'
    ];

    public function Evento()
    {
        return $this ->belongsTo(Evento:: class, 'id_evento');
    }

    public function Localidad()
    {
        return $this ->belongsTo(Localidad:: class, 'id_localidad');
    }
}
