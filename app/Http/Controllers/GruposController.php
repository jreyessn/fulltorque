<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temarios;
use App\Grupos;
use App\Grupos_usuarios;
use App\Grupos_temarios;
use App\User;
use App\Users_temarios;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class GruposController extends Controller
{
    public function index(){
        $temarios = Temarios::all();
        return view('grupos', compact("temarios"));
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
        if ($request->filled('password')) {
            $grupo->password = bcrypt($request->input('password'));
        }
        $temarios_id = $request->get("temarios_id", []);

        $grupo->save();
        $grupo->temarios_grupos()->sync($temarios_id);

        // Actualizar todos los usuarios con la contraseña nueva y temarios
        
        $grupos_usuarios = Grupos_usuarios::where("grupo_id", $grupo->id)->get();

        foreach ($grupos_usuarios as $grupo_usuario) {
            $user = $grupo_usuario->user;
            
            if ($request->filled('password')) {
                $user->password = $grupo->password;
                $user->save();
            }

            Users_temarios::where("user_id", $user->id)->delete();

            foreach ($temarios_id as $key => $temario_id) {
                $grupos_temarios = new Users_temarios();
                $grupos_temarios->user_id = $user->id;
                $grupos_temarios->temario_id = $temario_id;
                $grupos_temarios->save();
            }
            
        }

        $ultimo_id = Grupos::latest('id')->first();
        $ultimo_id = $ultimo_id->id;

        return response()->json(['success' => true, 'ultimo_id' => $ultimo_id]);
    }
}

public function show($id)
    {
        $grupo = Grupos::where('id',$id)->get();
        foreach ($grupo as $key => $value) {
            $value->temarios = grupos_temarios::where('grupo_id',$id)->get();
        }
        return $grupo[0];
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
        'password' => $id ? 'nullable|min:6|confirmed' : 'required|min:6|confirmed',

    ], [
        'nombre.required' => 'El nombre es obligatorio.',
        'curso.required' => 'El curso es obligatorio.',
        'cliente.required' => 'El cliente es obligatorio.',
        'tutor.required' => 'El tutor es obligatorio.',
        'fecha.required' => 'La fecha es obligatoria.',
        'hora.required' => 'La hora es obligatoria.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
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
            if ($key%2==0){
                $key2 = $key + 1;
                if(isset($grupos[$key2])){
                $value->siguiente = $grupos[$key2]; 
                unset($grupos[$key2]);
                }
            }
            $value->total_usuarios = Grupos_usuarios::select('grupos_usuarios*')->where('grupos_usuarios.grupo_id', $value->id)->where('users.deleted_at', null)->join('users', 'grupos_usuarios.users_id', '=', 'users.id')->count();
            }
            return Datatables::of($grupos)
                ->addIndexColumn()
                ->make(true);

        }

        return [];
    }

}
