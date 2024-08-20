<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\ClassLevel;
use App\BookType;

use Auth;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::orderBy('Name', 'ASC')->with(['user', 'class', 'type'])->paginate(10);

        return view('books.index')->with(['books' => $books]);
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
        $book_types = BookType::orderBy('Name')->get();

        return view('books.create')->with(['classes' => $classes, 'book_types' => $book_types]);
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
        // print_r($request->input());exit;

        $this->validate($request, [
            'Name' => 'required|string|min:1',
            'ISBN' => 'required|numeric',
            'Aurthor' => 'required|string',
            'Edition' => 'required|string',
            'BookTypeID' => 'integer|required',
            'ClassID' => 'integer|required',
            
        ]);
        $userID = Auth::user()->id;

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
        $book->save();
        

        return redirect()->back()->with('success', 'Book has been saved');
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
        $book = Book::with(['user', 'class', 'type'])->find($id);

        return view('books.show');
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
        $book_types = BookType::orderBy('Name')->get();
        $book = Book::with(['user', 'class', 'type'])->find($id);

        return view('books.edit')->with(['book' => $book, 'classes' => $classes, 'book_types' => $book_types]);
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
            'Name' => 'required|string|min:1',
            'ISBN' => 'required|numeric',
            'Aurthor' => 'required|string',
            'Edition' => 'required|string',
            'BookTypeID' => 'integer|required',
            'ClassID' => 'integer|required',
            
        ]);
        $userID = Auth::user()->id;

        $book = Book::find($id);
        $book->Name = $request->input('Name');
        $book->ISBN = $request->input('ISBN');
        $book->Aurthor = $request->input('Aurthor');
        $book->Edition = $request->input('Edition');
        $book->BookTypeID = $request->input('BookTypeID');
        $book->ClassID = $request->input('ClassID');
        $book->save();
        

        return redirect()->back()->with('success', 'Book has been updated');
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
        $book = Book::find($id);

        $book->delete();

        return redirect()->back()->with('error', 'Book has been deleted');

    }
}
