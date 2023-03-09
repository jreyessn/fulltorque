<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuarios');
    }

    /**
     * Display a listing datatable
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request){
        if ($request->ajax()) {
            $users = User::latest()->get();
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {
                    $deleteUrl = route('users.destroy', $row->id);

                    $actions = <<<EOT
                        <a data-toggle="modal" data-target="#addUserModal" data-title-modal="Editar Usuario" data-id_usuario="{$row->id}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-danger" onclick="deleteUser('{$deleteUrl}')"><i class="fas fa-trash"></i></button>

                    EOT;
                    return $actions;
                })
                ->rawColumns(['actions'])
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
        //
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


}
