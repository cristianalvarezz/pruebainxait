<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Models\GanadorModel;

class Controller extends BaseController
{
    public function ganador()
    {
        return view('ganador');
    }
    public function registro()
    {
        return view('registro');
    }
    public function volver()
    {
        return view('welcome');
    }
    public function all_departments(Request $request)
    {
        try {
            $sms = Http::acceptJson()->get("https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.min.json");
            return $sms;
        } catch (\Exception $ex) {
            return $ex;
        }
    }
    public function validar_registro(Request $request)
    {

        try {
            DB::beginTransaction();
            $tipo_documento = $request->tipo_documento;
            $documento = $request->documento;
            $nombre = $request->nombre;
            $apellido = $request->apellido;
            $email =  $request->email;
            $telefono = $request->telefono;

            $departamento = $request->departamento;
            $ciudad = $request->ciudad;
            $dp_nombre = $request->dp_nombre;
            $ci_nombre = $request->ci_nombre;

            $val_cc = UserModel::where("documento", $documento)->count();

            if ($val_cc > 0) {
                DB::rollBack();
                return response()->json([
                    'result' => false,
                    'data' => "Esta cédula ya se encuentra registrada",
                ]);
            } else if ($val_cc == 0) {
                $data = [
                    "tipo_documento" => $tipo_documento,
                    "documento" => $documento,
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "email" => $email,
                    "departamento" => $departamento,
                    "ciudad" => $ciudad,
                    "telefono" => $telefono,
                    "dp_nombre" => $dp_nombre,
                    "ci_nombre" => $ci_nombre
                ];
                DB::commit();
                return response()->json([
                    'result' => true,
                    'data' => "Validado para registrarse correctamente",
                    'info' => $data
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'result' => false,
                    'data' => "Ocurrió un error, intenta más tarde",
                ]);
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'data' => "Ocurrió un error, estoy en validar registro",
                'Exception' => $ex
            ]);
        }
    }
    public function registrouser(Request $request)
    {

        try {
            DB::beginTransaction();
            $tipo_documento = $request->data["tipo_documento"];
            $documento = $request->data["documento"];
            $nombre = $request->data["nombre"];
            $apellido = $request->data["apellido"];
            $departamento = $request->data["dp_nombre"];
            $ciudad = $request->data["ci_nombre"];
            $email = $request->data["email"];
            $telefono = $request->data["telefono"];
            $ldate = date('Y-m-d H:i:s');
            $origen = 0;

            $validar_email = UserModel::where('email', $email)->first();
            if ($validar_email) {
                return response()->json([
                    'result' => false,
                    'data' => "Este correo electrónico ya se encuentra registrado",
                ]);
            } else {
                $id = UserModel::insertGetId([
                    'id_tipo_documento' => $tipo_documento,
                    'documento' => $documento,
                    'nombres' => $nombre,
                    'apellidos' => $apellido,
                    'id_depart' => $departamento,
                    'id_ciudad' => $ciudad,
                    'email' => $email,
                    'celular' => $telefono,
                    'estado' => 1,
                    'created_at' =>  $ldate

                ]);

                $data = UserModel::where("id", $id)->first();

                DB::commit();

                return response()->json([
                    'result' => true,
                    'data' => "Registrado correctamente",
                    'data_user' => $data,
                ]);
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'result' => false,
                'data' => $ex,
            ]);
        }
    }
    public function excel()
    {
        return Excel::download(new UsersExport, 'listado_usuarios.xlsx');
    }

    public function generar_ganador()
    {
        $cantidadRegistros = DB::table('usuario')->count();

        if ($cantidadRegistros < 5) {
            return response()->json([
                'result' => false,
                'data' => "Aun no existe la cantidad suficiente de participantes para elegir un ganador",
            ]);
        } else {
            $ganador = GanadorModel::all();
            if ($ganador->isEmpty()) {
                $User = UserModel::orderByRaw('RAND()')->select('id')->limit(1)->get();
                $idUser =  $User[0]->id;
                $ganador = GanadorModel::insertGetId([
                    'idusuario' => $idUser
                ]);
                $nombreganador = DB::table('ganador')->join('usuario', 'usuario.id', '=', 'ganador.idusuario')->select('usuario.nombres')->get();
                return response()->json([
                    'result' => true,
                    'data' => "El nombre del ganador es el siguiente: ",
                    'nombreGanador' =>   $nombreganador[0]->nombres
                ]);
            } else {
                $nombreganador = DB::table('ganador')->join('usuario', 'usuario.id', '=', 'ganador.idusuario')->select('usuario.nombres')->get();
                return response()->json([
                    'result' => true,
                    'data' => "El nombre del ganador es el siguiente: ",
                    'nombreGanador' =>   $nombreganador[0]->nombres
                ]);
            }
        }
    }
}
