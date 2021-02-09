<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Material;
use Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('user.materials.index')->with('user', $user);
    }

    public function show($material)
    {
       return view('user.materials.show')->with('material', Material::find($material));
    }
}
