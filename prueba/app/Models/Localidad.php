<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    protected $table = 'localidad';
    protected $fillable = [
        'nombre'
    ];

    public function palcos()
    {
        return $this ->hasMany(Palco:: class);
    }
}
