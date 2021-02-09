<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subjects.index')->with('subjects', Subject::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create')->with('subjects', Subject::all());
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
            'subject' => 'required|min:3',
            'ects' => 'required',
            'selectSemester' => 'required'
        ]);

        Subject::insert([
            'name' => $request->subject,
            'ects' => $request->ects,
            'semester' => $request->selectSemester,
        ]);

        return redirect()->route('admin.subjects.index')->with('You have successfully added new subject');

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
        return view('admin.subjects.edit')->with('subject', Subject::find($id));
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
            'subject' => 'required|min:3',
            'ects' => 'required',
            'selectSemester' => 'required'
        ]);

        Subject::find($id)->update([
            'name' => $request->subject,
            'ects' => $request->ects,
            'semester' => $request->selectSemester,
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'You have successfully update subject');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);
        if ($subject->delete()) {
            return redirect()->route('admin.subjects.index')->with('success', 'You have successfully remove subject');
        }
        
    }
}
