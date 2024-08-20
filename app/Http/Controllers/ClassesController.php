<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassLevel;

use Auth;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classes = ClassLevel::orderBy('Name', 'ASC')->with(['user'])->paginate(10);

        return view('classes.index')->with(['classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('classes.create');
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
        $this->validate($request, [
            'Description' => 'nullable|string|min:3',
            'Level' => 'required|string',
            'Name' => 'required|string|min:1',
            
        ]);
        $userID = Auth::user()->id;
        // print_r($request->file('lib_file'));exit;

        $class = new ClassLevel;
        $class->Name = $request->input('Name');
        $class->Level = $request->input('Level');
        $class->AddedBy = $userID;
        $class->Description = $request->input('Description');
        
        $class->save();

        return redirect()->back()->with('success', 'Class Level Records have been saved');
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
        $class = ClassLevel::find($id)->with([]);

        return view('classes.show');
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
        $class = ClassLevel::with([])->find($id);

        return view('classes.edit')->with(['class' => $class]);
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
        $this->validate($request, [
            'Description' => 'nullable|string|min:1',
            'Level' => 'required|string',
            'Name' => 'required|string|min:1',
            
        ]);
        $userID = Auth::user()->id;
        // print_r($request->file('lib_file'));exit;

        $class = new ClassLevel;
        $class->Name = $request->input('Name');
        $class->Level = $request->input('Level');
        $class->Description = $request->input('Description');
        
        $class->save();

        return redirect()->back()->with('success', 'Class Level Records have been updated');
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
        $class = ClassLevel::find($id);

        $class->delete();

        return redirect()->back()->with('success', 'ClassLevel Records have been updated');

    }
}
