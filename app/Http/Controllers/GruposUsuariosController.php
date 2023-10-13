<?php

namespace App\Http\Controllers;

use App\Temarios;
use Illuminate\Http\Request;
use App\Grupos_usuarios;
use App\Grupos;
use App\User;
use App\Grupos_temarios;
use App\Users_temarios;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;



class GruposUsuariosController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $grupo = Grupos::select('grupos.*')->where('grupos.id', $id)->get();
        $temarios = Temarios::all();

        return view('grupos_usuarios', compact('grupo','temarios'));
    }

    public function store(Request $request)
    {
        $id = $request->input('id');
        $validator = $this->validateUser($request, $id);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } 
        else {
            if ($id) {
                // Actualizar un registro existente
                $user = User::findOrFail($id);
            } else {
                // Crear un nuevo registro
                $user = new User();
            }

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->telefono = $request->input('telefono');
            $user->rut = $request->input('rut');
            $user->password = $request->input('password');
            $user->save();

            if(!$id){
            $ultimo_id = User::latest('id')->first();
            $ultimo_id = $ultimo_id->id;
            }else{
            $ultimo_id = $id;
            }

            if($id){
            $users_temarios = Users_temarios::select('*')->where('user_id', $id)->get();
            if ($users_temarios) {
            foreach ($users_temarios as $key => $value) {
            $value->delete();
            }
            }
            }

            $temarios = Grupos_temarios::select('temario_id')->where('grupo_id', $request->input('grupo_id'))->get();
            foreach ($temarios as $key => $value) {
            $grupos_temarios = new Users_temarios();
            $grupos_temarios->user_id = $ultimo_id;
            $grupos_temarios->temario_id = $value->temario_id;
            $grupos_temarios->save();
            }

            if(!$id){
                $grupos_usuarios = new Grupos_usuarios();
                $grupos_usuarios->grupo_id = $request->input('grupo_id');
                $grupos_usuarios->users_id = $ultimo_id;
                $grupos_usuarios->save();
            }

        return response()->json(['success' => true, 'id_usuario' => $ultimo_id]);
    }
}

 protected function validateUser(Request $request, $id)
{
   
   return $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => [
            'required',
            'email',
            function ($attribute, $value, $fail) use ($id) {
                $users = User::where('email', $value)
                    ->whereNull('deleted_at')
                    ->where('id', '<>', $id)
                    ->count();
    
                if ($users > 0) {
                    $fail("El valor $attribute ya está en uso.");
                }
            },
        ],
        'password' => $id ? 'nullable|min:6|confirmed' : 'required|min:6|confirmed',
    ], [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El correo electrónico debe ser una dirección válida.',
        'email.unique' => 'Este correo electrónico ya ha sido registrado.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
    ]);

    
}

    public function destroy($id)
    {
        $grupo_usuario = Grupos_usuarios::where('users_id', $id);
        if ($grupo_usuario) {
            $grupo_usuario->delete();
        }
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function datatable($id, Request $request){
        if ($request->ajax()) {
        $grupos_usuarios = Grupos_usuarios::select('grupos_usuarios.*', 'users.name as nombre_usuario', 'users.email', 'users.telefono', 'users.rut', 'users.id as id_usuario')->where('grupos_usuarios.grupo_id', $id)->where('users.deleted_at', null)->join('users', 'grupos_usuarios.users_id', '=', 'users.id')->orderBy('grupos_usuarios.id','desc')->get();
        foreach ($grupos_usuarios as $key => $value) {
            $value->users_temarios = Grupos_usuarios::select('users_temarios.temario_id', 'users_temarios.user_id')->where('grupos_usuarios.grupo_id', $value->grupo_id)->where('users.deleted_at', null)->join('users', 'grupos_usuarios.users_id', '=', 'users.id')->join('users_temarios', 'grupos_usuarios.users_id', '=', 'users_temarios.user_id')->get();
            $value->temarios = Temarios::all();
        }

            return Datatables::of($grupos_usuarios)
                ->addIndexColumn()
                ->make(true);

        }

        return [];
    }

    public function getGrupo(Request $request)
    {
        $id = $request->input('id');
        $grupo = Grupos::where('id', $id)->get();
        foreach ($grupo as $key => $value) {
           $value->temarios = Grupos_temarios::where('grupo_id', $id)->get();

        }
        return $grupo[0];

    }



}
