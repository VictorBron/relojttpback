<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $fillable = ['rut', 'dv', 'sap', 'nombres', 'apellido_paterno', 'apellido_materno', 'calle', 'numero', 'depto', 'region', 'provincia', 'comuna', 'mail', 'password', 'nivel', 'acepta_mail'];
    protected $table = 'asistencia.personal';
}