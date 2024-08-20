<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Student;
use App\ClassLevel;
use App\School;
use App\Titles;
use App\OtherUser;
use App\Book;
use Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = Student::orderBy('FirstName')->with(['user','class', 'other_usr', 'school'])->paginate(10);

        return view('students.index')->with(['students' => $students]);


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
        return view('students.create')->with(['classes' => $classes, 'schools' => $schools, 'titles' => $titles]);
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
            'MiddleName' => ['nullable', 'string', 'max:255'],
            'SurName' => ['required', 'string', 'max:255'],
            'title' => ['required', 'integer'],
            'gender' => ['required', 'string'],
            'ClassID' => ['required', 'integer'],
            'SchoolID' => ['required', 'integer'],
            'PhoneNumber' => ['required', 'digits:9'],
            'DOB' => ['required', 'string'],
            'ParentName' => ['required', 'string'],
        ]);

        $userID = Auth::user()->id;

        
        // $password = str_replace(' ', '', strtolower($request->input('ParentName'))).date('dm', strtotime($request->input('DOB')));
        $password = 'password';
        $email = strtolower($request->input('FirstName').$request->input('SurName')).'@example.com';
        $check = OtherUser::where('email', $email)->get();
        if(count($check) > 0){
            $check = count($check)+1;
            $email = strtolower($request->input('FirstName').$request->input('SurName')).$check.'@example.com';
        }
        
        $student = new Student;
        $student->FirstName = $request->input('FirstName');
        $student->MiddleName = $request->input('MiddleName');
        $student->SurName = $request->input('SurName');
        $student->ClassID = $request->input('ClassID');
        $student->SchoolID = $request->input('SchoolID');
        $student->ParentContact = $request->input('PhoneNumber');
        $student->DOB = $request->input('DOB');
        $student->ParentName = $request->input('ParentName');
        $student->AddedBy = $userID;
        
        if($student->save()){
            $obfuscator = Str::random(10);
            $user = new OtherUser;

            $user->name = $student->FirstName = $request->input('FirstName').' '.$student->MiddleName = $request->input('MiddleName').' '.$student->SurName = $request->input('SurName');
            $user->email = $email;
            $user->title = $request->input('title');
            $user->gender = $request->input('gender');
            $user->StudentID = $student->id;
            $user->validity = 1;
            $user->UserRole = 0;
            $user->Obfuscator = $obfuscator;
            $user->password = Hash::make($password);
            $user->title = $request->input('title');
            $user->gender = $request->input('gender');
            $user->save();

            return redirect()->back()->with('success', 'Student has been added successfully');

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
        $student = Student::with(['user','class', 'other_usr', 'school'])->find($id);

        return view('students.show')->with(['student' => $student, 'classes' => $classes, 'schools' => $schools, 'titles' => $titles]);
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

        $student = Student::with(['user','class', 'other_usr', 'school'])->find($id);

        return view('students.edit')->with(['student' => $student, 'classes' => $classes, 'schools' => $schools, 'titles' => $titles]);
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
            'MiddleName' => ['nullable', 'string', 'max:255'],
            'SurName' => ['required', 'string', 'max:255'],
            'title' => ['required', 'integer'],
            'gender' => ['nullable', 'string'],
            'ClassID' => ['required', 'integer'],
            'SchoolID' => ['required', 'integer'],
            'PhoneNumber' => ['required', 'digits:9'],
            'DOB' => ['required', 'string'],
            'ParentName' => ['required', 'string'],
        ]);

        $userID = Auth::user()->id;

        $password = str_replace(' ', '', strtolower($request->input('ParentName'))).date('dm', strtotime($request->input('DOB')));
        
        $email = strtolower($request->input('FirstName').$request->input('SurName')).'@example.com';
        $check = OtherUser::where('email', $email)->get();
        if(count($check) > 0){
            $check = count($check)+1;
            $email = strtolower($request->input('FirstName').$request->input('SurName')).$check.'@example.com';
        }
        
        $student = Student::find($id);
        $student->FirstName = $request->input('FirstName');
        $student->MiddleName = $request->input('MiddleName');
        $student->SurName = $request->input('SurName');
        $student->ClassID = $request->input('ClassID');
        $student->SchoolID = $request->input('SchoolID');
        $student->ParentContact = $request->input('PhoneNumber');
        $student->DOB = $request->input('DOB');
        $student->ParentName = $request->input('ParentName');
        
        if($student->save()){
            $obfuscator = Str::random(10);
            $user = OtherUser::where('StudentID', $student->id)->first();
            $gender = $user->gender;

            $user->name = $student->FirstName = $request->input('FirstName').' '.$student->MiddleName = $request->input('MiddleName').' '.$student->SurName = $request->input('SurName');
            $user->email = $email;
            $user->title = $request->input('title');
            $user->gender = $request->input('gender');

            if ($request->input('gender') != '') {
                $user->gender = $request->input('gender');
            }

            if ($request->input('password') != '') {
                $user->password = Hash::make($password);
            }
            $user->save();

            return redirect()->back()->with('success', 'Student has been added successfully');

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
        $student = Student::find($id);
        $other_student = Student::where('StudentID', $student->id);

        $student->delete();
        $other_student->delete();

        return redirect()->back()->with('error', 'Record has been deleted');
    }
}
