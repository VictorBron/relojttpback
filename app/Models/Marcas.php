<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'idpersona', 'fecha_marcaje', 'ip', 'movimiento', 'metodo', 'hasht', 'fecha_registro'];
    protected $table = 'asistencia.marcas';
}
