<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Teacher;
use App\ClassLevel;
use App\School;
use App\Titles;
use App\OtherUser;
use App\Book;
use App\BookType;
use Auth;

class SeshTeachersController extends Controller
{
    //
    public function startup_page()
    {
        // if(Auth::guard('other_user')->user()){
            $teachers = Teacher::orderBy('FirstName')->with(['user','class', 'other_usr', 'school'])->where('SchoolID', Auth::guard('other_user')->user()->id)
            ->paginate(10);
            // print_r($teachers)
    
            return view('other_users.index')->with(['teachers' => $teachers]);
        // }else{
        //     return redirect('/');
        // }
    }

    public function insert_books()
    {
        $class = Auth::guard('other_user')->user()->teacher->class;
        $book_types = BookType::orderBy('Name')->get();
        return view('other_users.teacher.insert_book')->with(['class' => $class, 'book_types' => $book_types]);
    }

    public function post_insert_books(Request $request)
    {
        // print_r($request->file());exit;
        $this->validate($request, [
            'Name' => 'required|string|min:1',
            'ISBN' => 'required|numeric',
            'Aurthor' => 'required|string',
            'Edition' => 'required|string',
            'BookTypeID' => 'integer|required',
            'ClassID' => 'integer|required',
            
        ]);
        $userID = Auth::guard('other_user')->user()->id;

        $path1 = $request->input('directory_name');
        if ($request->hasFile('file')) {
            $this->validate($request, [
                'file' => 'required|mimes:pdf,docx,doc'
            ]);

            // Get filename wuth the extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();

            // Get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('file')->getClientOriginalExtension();

            // Create file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('file')->storeAs('public/'.$path1, $fileNameToStore);

        } else {
            $fileNameToStore = 'no';
            $extension = 'file';
            return redirect()->back()->withInput()->with('error', 'Please attach a book');
            exit;
        }
        

        $book = new Book;
        $book->Name = $request->input('Name');
        $book->ISBN = $request->input('ISBN');
        $book->Aurthor = $request->input('Aurthor');
        $book->Edition = $request->input('Edition');
        $book->BookTypeID = $request->input('BookTypeID');
        $book->ClassID = $request->input('ClassID');
        $book->AddedBy = $userID;
        $book->Location = $path1.'/'.$fileNameToStore;
        $book->Teacher = 1;
        $book->save();
        

        return redirect()->back()->with('success', 'Book has been saved');
    }

    public function list_books()
    {
        $books = Book::orderBy('Name', 'ASC')->with(['user', 'class', 'type'])->paginate(10);
        
        return view('other_users.student.booklist')->with(['books' => $books]);
    }
}
