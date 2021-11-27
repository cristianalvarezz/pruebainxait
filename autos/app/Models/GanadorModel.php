<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GanadorModel extends Model
{
    public $table ='ganador';
    public $timestamps = false;

    protected $filleable =[
        
        'idusuario'
    ];
}
