<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformesController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    //
    public function general(Request $request)
    {
        $result = DB::select('EXEC asistencia.SP_MARCAS_GENERAL_2 ?,?', array($request->fechauno, $request->fechados));
        return $result;
    }

    public function sap(Request $request)
    {
        $result = DB::select('EXEC asistencia.SP_MARCAS_SAP ?,?', array($request->fechauno, $request->fechados));
        return $result;
    }

    public function general2(Request $request)
    {
        $result = DB::select('EXEC asistencia.MarcasDiariasttp null,?,?', array($request->fechauno, $request->fechados));
        return $result;
    }
}
