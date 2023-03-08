<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
  
 public function index(Request $request)
{
	//dd($request->ajax());
   if ($request->ajax()) {
	   $users = User::latest()->get();
	    return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                $editUrl = route('users.edit', $row->id);
                $deleteUrl = route('users.destroy', $row->id);
                $viewUrl = route('users.show', $row->id);
                $csrfToken = csrf_token();
                $actions = <<<EOT
                    <a href="#" class="btn btn-info" onclick="viewUser({{ $row->id }})"><i class="fas fa-eye"></i></a>
                    <a href="{$editUrl}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                    <button type="button" class="btn btn-danger" onclick="deleteUser('{$deleteUrl}', '{$csrfToken}')"><i class="fas fa-trash"></i></button>

                EOT;
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);

        }
    
    
    return view('usuarios');
}

    public function store()
    {
    	// <a href="#" class="btn btn-info btn-sm" onclick="viewUser({{ $row->id }})"><i class="fas fa-eye"></i></a>
    }

    public function edit(User $user)
{
    return view('users.edit', compact('user'));
}

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

public function show($id)
{
    $user = User::findOrFail($id);

    return view('usuarios.show', compact('user'));
}


}
