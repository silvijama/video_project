<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\User;
use App\Material;
use Auth;
use DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        //$subject = Subject::find(5);
        //$material = Material::find(1);


        return view('editor.subjects.index')->with('user', $user);

        /*foreach($subject->materials as $subject) {
            echo $subject, '<br>';
        } */
    

        /* Prikazuje koje user ima predmete, zatim ispisuje koje ti predmeti imaju materijale */
        foreach($user->subjects as $subject) {
            echo $subject->name, " ";
            foreach($subject->materials as $material) {
                echo $material->name, '<br>';
            }
        }

        exit;

        // Pronaci sve njegove predmete

        $user_id = Auth::user()->id;


        $editorSubjects = DB::table('editor_subjects')
                                ->where('user_id', $user_id)
                                ->get();

        print_r($editorSubjects);
        exit;

        return view('editor.subjects.index')->with('subjects', $subjectsOfEditor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editor.subjects.create')->with('subjects', Subject::all());
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
            'selectSubject' => 'required|',
        ]);

        $editor_subject = DB::table('subjects_users')->insert([
            'subject_id' => $request->selectSubject,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('editor.subjects.index')->with('success', 'You have successfully added subject');
        
        
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
        //
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
    public function destroy(Subject $subject)
    {
        $user = Auth::user();
        $del = DB::table('subjects_users')->where('subject_id', $subject->id)->where('user_id', $user->id)->delete();
        if ($del) {
            return redirect()->route('editor.subjects.index')->with('success', 'You have successfully remove subject');
        } 
        return redirect()->route('editor.subjects.index')->with('warning', 'You have not successfully remove subject');
        
    }
}
