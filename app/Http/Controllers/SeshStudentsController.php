<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\School;
use App\Titles;
use App\OtherUser;
use App\Book;
use App\Student;
use Auth;

class SeshStudentsController extends Controller
{
    //
    public function startup_page()
    {
        // if(Auth::guard('other_user')->user()){
            $students = Student::orderBy('FirstName')->with(['user','class', 'other_usr', 'school'])->where('SchoolID', Auth::guard('other_user')->user()->id)
            ->paginate(10);
            // print_r($students)
    
            return view('other_users.index_students')->with(['students' => $students]);
        // }else{
        //     return redirect('/');
        // }
    }

    public function list_books()
    {
        $student = Student::find(Auth::guard('other_user')->user()->StudentID);
        $books = Book::orderBy('Name', 'ASC')->with(['user', 'class', 'type'])->paginate(10);
        
        return view('other_users.student.booklist')->with(['books' => $books]);
    }

    public function get_book_type($type)
    {
        $books = Book::orderBy('Name', 'ASC')->with(['user', 'class', 'type'])->where('BookTypeID', $type)->paginate(10);

        return view('other_users.student.booklist')->with(['books' => $books]);
    }

}
