<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{

    use HasFactory;

    protected $table = 'evento';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'municipio',
        'departamento',
        'id_artista'
    ];

    public function Artista()
    {
        return $this ->belongsTo(Artista:: class, 'id_artista');
    }

    public function palcos()
    {
        return $this ->hasMany(Palco:: class);
    }


}
