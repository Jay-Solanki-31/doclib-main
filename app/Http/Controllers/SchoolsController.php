<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use Auth;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $schools = School::orderBy('Name', 'ASC')->with(['user'])->paginate(10);

        return view('schools.index')->with(['schools' => $schools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('schools.create');
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
            'lib_file' => 'nullable|mimes:jpeg,png,jpg',
            'Name' => 'required|string|min:3',
            'PhyiscalLocation' => 'required|string|min:3',
            'Motto' => 'required|string|min:3',
            'PrimaryContact' => 'required|integer|digits:9',
        ]);
        $userID = Auth::user()->id;
        // print_r($request->file('lib_file'));exit;

        $school = new School;
        $school->Name = $request->input('Name');
        $school->PhyiscalLocation = $request->input('PhyiscalLocation');
        $school->Motto = $request->input('Motto');
        $school->PrimaryContact = $request->input('PrimaryContact');
        $school->AddedBy = $userID;


        if ($request->hasFile('lib_file')) {

            // Get filename wuth the extension
            $fileNameWithExt = $request->file('lib_file')->getClientOriginalName();

            // Get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('lib_file')->getClientOriginalExtension();

            // Create file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('lib_file')->storeAs('public/img/logo', $fileNameToStore);

        } else {

            return redirect()->back()->with('error', 'Please upload a file before you submit');

        }
        $school->Logo = $fileNameToStore;
        $school->save();

        return redirect()->back()->with('success', 'School Records have been saved');
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
        $school = School::find($id)->with([]);

        return view('schools.show');
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
        $school = School::with(['user'])->find($id);

        return view('schools.edit')->with(['school' => $school]);
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
            'lib_file' => 'nullable|mimes:jpeg,png,jpg',
            'Name' => 'required|string|min:3',
            'PhyiscalLocation' => 'required|string|min:3',
            'Motto' => 'required|string|min:3',
            'PrimaryContact' => 'required|integer|digits:9',
        ]);
        $userID = Auth::user()->id;
        // print_r($request->file('lib_file'));exit;

        $school = School::find($id);
        $school->Name = $request->input('Name');
        $school->PhyiscalLocation = $request->input('PhyiscalLocation');
        $school->Motto = $request->input('Motto');
        $school->PrimaryContact = $request->input('PrimaryContact');
        // $school->AddedBy = $userID;


        if ($request->hasFile('lib_file')) {

            // Get filename wuth the extension
            $fileNameWithExt = $request->file('lib_file')->getClientOriginalName();

            // Get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('lib_file')->getClientOriginalExtension();

            // Create file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('lib_file')->storeAs('public/img/logo', $fileNameToStore);

            $school->Logo = $fileNameToStore;

        }

        $school->save();

        return redirect()->back()->with('success', 'School Records have been updated');
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
        $school = School::find($id);

        $school->delete();

        return redirect()->back()->with('success', 'School Records have been updated');

    }
}
