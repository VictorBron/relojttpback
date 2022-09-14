<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $personal = DB::select('SELECT p.id, c.comuna_id, r.region_id, pr.provincia_id, p.rut, p.dv, p.sap, p.nombres, p.apellido_paterno, p.apellido_materno, p.calle, p.numero, p.depto, r.region_nombre, pr.provincia_nombre, c.comuna_nombre, p.mail, n.nombre FROM asistencia.personal p, asistencia.comunas c, asistencia.regiones r, asistencia.provincias pr, asistencia.nivel_usuario n WHERE p.region = r.region_id AND p.comuna = c.comuna_id AND p.provincia = pr.provincia_id AND p.region = r.region_id AND p.nivel = n.idnivel_usuario '); // Consulta manual
        $personal = DB::select('SELECT * FROM asistencia.personal');
        /* $personal = Personal::all(); */
        return $personal;
    }

    public function store(Request $request)
    {
        if ($request->depto == null) {
            $request->depto = "";
        }
        $result = DB::insert('INSERT INTO asistencia.personal (
            rut,
            dv, 
            sap,
            nombres,
            apellido_paterno, 
            apellido_materno, 
            calle,
            numero,
            depto,
            region,
            provincia, 
            comuna,
            mail, 
            password,
            nivel,
            acepta_mail
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array(
            $request->rut,
            $request->dv,
            $request->codigoSap,
            $request->nombres,
            $request->apellidoPaterno,
            $request->apellidoMaterno,
            $request->calleCasa,
            $request->numeroCasa,
            $request->depto,
            $request->region,
            $request->provincia,
            $request->comuna,
            $request->email,
            $request->password,
            $request->perfil,
            $request->mailAsistencia
        ));
        return $request;
    }


    public function show($id)
    {
        $persona = Personal::find($id);
        return $persona;
    }

    public function login(Request $request)
    {
        $personal = DB::select('SELECT nombres, apellido_paterno, apellido_materno,mail FROM asistencia.personal WHERE mail = ? AND password= ?', array($request->email, $request->password)); // Consulta manual

        if (isset($personal[0])) {
            /*  $logged = array("logged" => "true");
            array_push($personal, $logged); */
            return $personal[0];
        } else {
            return false;
        }
    }

    public function update(Request $request)
    {
        DB::update('UPDATE asistencia.personal
                SET 
                    acepta_mail = ?,
                    apellido_materno = ?,
                    apellido_paterno = ?,
                    calle = ?,
                    comuna = ?,
                    depto = ?,
                    dv = ?,
                    mail = ?,
                    nivel = ?,
                    nombres = ?,
                    numero = ?,
                    provincia = ?,
                    region = ?,
                    rut= ?,
                    sap = ?,
                    password = ?
                WHERE id = ?', array(
            $request->acepta_mail,
            $request->apellido_materno,
            $request->apellido_paterno,
            $request->calle,
            $request->comuna,
            $request->depto,
            $request->dv,
            $request->mail,
            $request->nivel,
            $request->nombres,
            $request->numero,
            $request->provincia,
            $request->region,
            $request->rut,
            $request->sap,
            $request->password,
            $request->id
        ));
    }

    public function destroy($id)
    {
        DB::delete("DELETE FROM asistencia.personal WHERE id = ?", array($id));
        return "Eliminado";
    }
}
