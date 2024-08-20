<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Teacher;
use App\ClassLevel;
use App\School;
use App\Titles;
use App\OtherUser;
use App\Book;
use Auth;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teachers = Teacher::orderBy('FirstName')->with(['user','class', 'other_usr', 'school'])->paginate(10);
        // print_r($teachers[0]->other_usr);exit;

        return view('teachers.index')->with(['teachers' => $teachers]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $classes = ClassLevel::orderBy('Name')->get();
        $titles = Titles::orderBy('TitleName')->get();

        $schools = School::orderBy('Name')->get();
        return view('teachers.create')->with(['classes' => $classes, 'schools' => $schools, 'titles' => $titles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'FirstName' => ['required', 'string', 'max:255'],
            'MiddleName' => ['required', 'string', 'max:255'],
            'SurName' => ['required', 'string', 'max:255'],
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'title' => ['required', 'integer'],
            'gender' => ['required', 'string'],
            'ClassID' => ['required', 'integer'],
            'SchoolID' => ['required', 'integer'],
            'PhoneNumber' => ['required', 'digits:9'],
        ]);

        $userID = Auth::user()->id;

        // print_r($request->input());exit;
        
        $teacher = new Teacher;
        $teacher->FirstName = $request->input('FirstName');
        $teacher->MiddleName = $request->input('MiddleName');
        $teacher->SurName = $request->input('SurName');
        $teacher->Email = $request->input('Email');
        $teacher->ClassID = $request->input('ClassID');
        $teacher->SchoolID = $request->input('SchoolID');
        $teacher->PhoneNumber = $request->input('PhoneNumber');
        $teacher->AddedBy = $userID;
        
        if($teacher->save()){
            $obfuscator = Str::random(10);
            $user = new OtherUser;

            $user->name = $teacher->FirstName = $request->input('FirstName').' '.$teacher->MiddleName = $request->input('MiddleName').' '.$teacher->SurName = $request->input('SurName');
            $user->email = $request->input('Email');
            $user->title = $request->input('title');
            $user->gender = $request->input('gender');
            $user->TeacherID = $teacher->id;
            $user->validity = 1;
            $user->UserRole = 1;
            $user->Obfuscator = $obfuscator;
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return redirect()->back()->with('success', 'Teacher has been added successfully');

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
        $classes = ClassLevel::orderBy('Name')->get();
        $titles = Titles::orderBy('TitleName')->get();

        $schools = School::orderBy('Name')->get();
        $teacher = Teacher::with(['user','class', 'other_usr', 'school'])->find($id);

        return view('teachers.show')->with(['teacher' => $teacher, 'classes' => $classes, 'schools' => $schools, 'titles' => $titles]);
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
        $classes = ClassLevel::orderBy('Name')->get();
        $titles = Titles::orderBy('TitleName')->get();

        $schools = School::orderBy('Name')->get();

        $teacher = Teacher::with(['user','class', 'other_usr', 'school'])->find($id);

        return view('teachers.edit')->with(['teacher' => $teacher, 'classes' => $classes, 'schools' => $schools, 'titles' => $titles]);
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
        $this->validate($request, [
            'FirstName' => ['required', 'string', 'max:255'],
            'MiddleName' => ['required', 'string', 'max:255'],
            'SurName' => ['required', 'string', 'max:255'],
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'title' => ['required', 'integer'],
            'gender' => ['nullable', 'string'],
            'ClassID' => ['required', 'integer'],
            'SchoolID' => ['required', 'integer'],
            'PhoneNumber' => ['required', 'digits:9'],
        ]);

        $userID = Auth::user()->id;
        // print_r($request->input());exit;
        
        $teacher = Teacher::find($id);
        $teacher->FirstName = $request->input('FirstName');
        $teacher->MiddleName = $request->input('MiddleName');
        $teacher->SurName = $request->input('SurName');
        $teacher->Email = $request->input('Email');
        $teacher->ClassID = $request->input('ClassID');
        $teacher->SchoolID = $request->input('SchoolID');
        $teacher->PhoneNumber = $request->input('PhoneNumber');
        // $teacher->AddedBy = $userID;
        
        if($teacher->save()){
            $obfuscator = Str::random(10);
            $user = OtherUser::where('TeacherID', $teacher->id)->first();
            // $user = OtherUser::find($user->id);
            $gender = $user->gender;

            $user->name = $teacher->FirstName = $request->input('FirstName').' '.$teacher->MiddleName = $request->input('MiddleName').' '.$teacher->SurName = $request->input('SurName');
            $user->email = $request->input('Email');
            $user->title = $request->input('title');

            if ($request->input('gender') != '') {
                $user->gender = $request->input('gender');
            }

            if ($request->input('password') != '') {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();

            return redirect()->back()->with('success', 'Teacher has been added successfully');

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
        $teacher = Teacher::find($id);
        $other_teacher = Teacher::where('TeacherID', $teacher->id);

        $teacher->delete();
        $other_teacher->delete();

        return redirect()->back()->with('error', 'Record has been deleted');
    }
}
