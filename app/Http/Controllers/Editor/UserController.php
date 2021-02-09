<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function index ()
    {
        $users = User::where('type', null)
                    ->orWhere('type', 'user')
                    ->get();
        
        return view('editor.users.index')->with('users', $users);
    }

    public function show ($id)
    {
        return view('editor.users.show')->with('user', User::find($id));
    }

    public function searchUser (Request $request) 
    {   
        //return User::where('name', 'like', '%' . $request->input('query') . '%')->get();
        if ($request->ajax()) {
            $query = $request->get('query');

            if ($query != '') {
                $data = User::where('name', 'like', '%' . $query . '%')->get();
            } else {
                $data = '';
            }

            echo json_encode($data);
        }
    }
}
