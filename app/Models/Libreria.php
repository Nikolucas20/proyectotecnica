<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libreria extends Model
{

    protected $table = 'library';

    protected $fillable = [
        'nombre',
        'genero',
        'autor',
        'lenguaje'
    ];

}