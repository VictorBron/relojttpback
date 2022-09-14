<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marcas;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcasController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $result = DB::select('SELECT * FROM asistencia.marcas WHERE idpersona = ? AND fecha_marcaje BETWEEN ? AND ? ', array($request->id, $request->fechauno, $request->fechados));
        return $result;
    }
    protected function obtenerId($rut)
    {
        $persona = DB::select('SELECT id FROM asistencia.personal WHERE rut =?', array($rut));
        return $persona;
    }

    public function getMarcaById($id)
    {
        $persona = DB::select('SELECT * FROM asistencia.marcas WHERE id = ?', array($id));
        return $persona;
    }
    public function store(Request $request)
    {

        $fecha = str_replace("T", " ", $request->fecha_marcaje);
        return DB::insert('EXEC asistencia.InsertaMarcas ?,?,?,?,?', array(
            $request->id,
            $fecha,
            $request->ip,
            $request->movimiento,
            $request->hasht
        ));
    }


    public function addMarcaByRut(Request $request)
    {
        $id = $this->obtenerId($request->rut);

        if ($id == "") {
            return array("msg" => "Rut indicado no existe");
        }

        $id = $id[0]->id;
        DB::insert('EXEC asistencia.InsertaMarcas ?,?,?,?,?', array(
            $id,
            $request->fecha_marcaje,
            $request->ip,
            $request->movimiento,
            $request->hasht
        ));

        return $request;
    }



    public function destroy($id)
    {
        $result = DB::delete("DELETE FROM asistencia.marcas WHERE id = ?", array($id));

        return $id;
    }


    public function update(Request $request, $id)
    {
        $fecha = $request->fecha_marcaje;
        if (strpos($fecha, "T")) {
            $fecha = str_replace("T", " ", $request->fecha_marcaje);
        }
        DB::update('UPDATE asistencia.marcas
                SET 
                    fecha_marcaje = ?,
                    ip = ?,
                    movimiento= ?,
                    metodo = ?,
                    hasht = ?
                WHERE id = ?', array(
            $fecha,
            $request->ip,
            $request->movimiento,
            $request->metodo,
            $request->hasht,
            $id
        ));
        return "ok";
    }
}
