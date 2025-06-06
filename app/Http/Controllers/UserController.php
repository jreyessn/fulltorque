<?php

namespace App\Http\Controllers;

use App\Temarios;
use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temarios = Temarios::all();

        return view('usuarios', compact("temarios"));
    }

    /**
     * Display a listing datatable
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request){
        if ($request->ajax()) {
            $users = User::get();
            return Datatables::of($users)
                ->addIndexColumn()
                ->make(true);

        }

        return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
{
    $id = $request->input('id');
    $validator = $this->validateUser($request, $id);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()]);
    } else {
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
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $temarios_id = $request->get("temarios_id", []);

        $user->save();
        $user->temarios()->sync($temarios_id);

        return response()->json(['success' => true]);
    }
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
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
        'telefono.required' => 'El telefono es obligatorio.',
        'rut.required' => 'El rut es obligatorio.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
    ]);

    
}


}
