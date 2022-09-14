<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UbicacionesController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    public function getProvincias()
    {
        $result = db::select('SELECT * FROM asistencia.provincias');
        return $result;
    }
    public function getComunas()
    {
        $result = db::select('SELECT * FROM asistencia.comunas');
        return $result;
    }
    public function getRegiones()
    {
        $result = db::select('SELECT * FROM asistencia.regiones');
        return $result;
    }
}
