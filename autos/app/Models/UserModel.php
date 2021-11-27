<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
   
    public $table = 'usuario';
    public $timestamps = false;

    protected $filleable=[
        'documento',
        'nombres',
        'apellidos',
        'email',
        'celular',

        'id_depart',
        'id_ciudad',
        'id_tipo_documento',
        'estado',
        'origen',
        'created_at'
    ];
}
