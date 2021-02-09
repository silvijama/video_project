<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Subject;
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
        $user_id = Auth::user()->id;
        
        return view('user.subjects.index')->with('user', User::find($user_id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.subjects.create')->with('subjects', Subject::all());
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
            
            'selectSubject' => ['required','unique:subjects_users,subject_id,' . $request->selectSubject . ',id,user_id,' . Auth::user()->id]

        ]);

        DB::table('subjects_users')->insert([
            'subject_id' => $request->selectSubject,
            'user_id'    => Auth::user()->id,
        ]);

        return redirect()->route('user.subjects.index')->with('success', 'You have successfully added new subject');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('user.subjects.show')->with('subject', Subject::find($id));
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
            return redirect()->route('user.subjects.index')->with('success', 'You have successfully remove subject');
        } 
        
        return redirect()->route('user.subjects.index')->with('warning', 'You have not successfully remove subject');
    }

    public function searchSubject(Request $request)
    {
        
        if ($request->ajax()) {
            $query = $request->get('query');

            if ($query != '') {
                $data = Subject::where('name', 'like', '%' . $query . '%')->get();
            } else {
                //$data = Subject::orderBy('id', 'desc')->get();
                $data = '';
            }

            echo json_encode($data);
        }
    }
}
