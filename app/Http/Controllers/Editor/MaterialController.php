<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material;
use App\Subject;
use App\User;
use Auth;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('editor.materials.index')->with('user', $user);
      
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('editor.materials.create')->with('user', User::find(Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subjectName' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);
        
        if ($request->hasFile('file')) {
            foreach ($request->file as $file) {
                $filename = $file->getClientOriginalName();
                //$file->storeAs('public/upload', $filename);
                $file->move('storage/', $filename);

                $material = new Material();
                $material->file = $filename;
                
            }

            $material->name        = $request->subjectName;
            $material->description = $request->description;
            $material->subject_id  = $request->subjectSelect;
            if ($material->save()) {
                return redirect()->route('editor.materials.index')->with('success', 'You have successfully added materials');
            }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('editor.materials.edit')->with(['material' => Material::find($id), 'user' =>  User::find(Auth::user()->id)]);
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
        $request->validate([
            'subjectName' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);

        $material = Material::find($id);

        $material->name        = $request->subjectName;
        $material->subject_id  = $request->subjectSelect;
        $material->description = $request->description;
        $material->file        = $request->file;

        if ($material->save()) {
            return redirect()->route('editor.materials.index')->with('success', 'You have successfully updated material');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
