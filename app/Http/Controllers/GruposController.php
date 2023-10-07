<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temarios;
use App\Grupos;
use App\Grupos_usuarios;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class GruposController extends Controller
{
    public function index(){
        $temarios = Temarios::all();
        return view('grupos', compact("temarios", "grupos"));
    }

    public function store(Request $request)
{
    $id = $request->input('id');
    $validator = $this->validateGrupo($request, $id);
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()]);
    } else {
        if ($id) {
            // Actualizar un registro existente
            $grupo = Grupos::findOrFail($id);
        } else {
            // Crear un nuevo registro
            $grupo = new Grupos();
        }

        $grupo->nombre = $request->input('nombre');
        $grupo->curso = $request->input('curso');
        $grupo->cliente = $request->input('cliente');
        $grupo->tutor = $request->input('tutor');
        $grupo->fecha = $request->input('fecha');
        $grupo->hora = $request->input('hora');
        $grupo->save();
        return response()->json(['success' => true]);
    }
}

public function show($id)
    {
        $grupo = Grupos::findOrFail($id);

        return $grupo;
    }

  public function update(Request $request, $id)
    {
        //
    }

 public function destroy($id)
    {
        $grupo = Grupos::find($id);
        if ($grupo) {
            $grupo->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

 public function total_usuarios(Request $request)
{
    $id = $request->input('id');
    $grupos_usuarios = Grupos_usuarios::select('grupos_usuarios*')->where('grupos_usuarios.grupo_id', $id)->where('users.deleted_at', null)->join('users', 'grupos_usuarios.users_id', '=', 'users.id')->count();
    echo json_encode($grupos_usuarios);

}

protected function validateGrupo(Request $request, $id)
{
   
   return $validator = Validator::make($request->all(), [
        'nombre'  => 'required',
        'curso' => 'required',
        'cliente' => 'required',
        'tutor' => 'required',
        'fecha' => 'required',
        'hora' => 'required',
    ], [
        'nombre.required' => 'El nombre es obligatorio.',
        'curso.required' => 'El curso es obligatorio.',
        'cliente.required' => 'El cliente es obligatorio.',
        'tutor.required' => 'El tutor es obligatorio.',
        'fecha.required' => 'La fecha es obligatoria.',
        'hora.required' => 'La hora es obligatoria.',
    ]);

    
}

public function gestion_usuarios()
    {

        return view('grupos_usuarios');
    }

    public function datatable(Request $request){
        if ($request->ajax()) {
            $grupos = Grupos::orderBy('id', 'desc')->get();
            foreach ($grupos as $key => $value) {
            /*if (!$key%2==0){

            echo json_encode($value);
            }*/
            $value->total_usuarios = Grupos_usuarios::select('grupos_usuarios*')->where('grupos_usuarios.grupo_id', $value->id)->where('users.deleted_at', null)->join('users', 'grupos_usuarios.users_id', '=', 'users.id')->count();
            }
            return Datatables::of($grupos)
                ->addIndexColumn()
                ->make(true);

        }

        return [];
    }

}
