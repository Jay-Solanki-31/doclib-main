<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookType;
use Auth;

class BookTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $book_types = BookType::orderBy('Name', 'ASC')->with(['user'])->paginate(10);

        return view('book_types.index')->with(['book_types' => $book_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('book_types.create');
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
            'Name' => 'required|string|min:1',
            
        ]);
        $userID = Auth::user()->id;
        // print_r($request->file('lib_file'));exit;

        $book_type = new BookType;
        $book_type->Name = $request->input('Name');
        $book_type->AddedBy = $userID;
        $book_type->Description = $request->input('Description');
        
        $book_type->save();

        return redirect()->back()->with('success', 'Subject/Category added Records have been saved');
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
        $book_type = BookType::find($id)->with([]);

        return view('book_types.show');
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
        $book_type = BookType::with([])->find($id);

        return view('book_types.edit')->with(['book_type' => $book_type]);
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
            'Name' => 'required|string|min:1',
            
        ]);
        $userID = Auth::user()->id;
        // print_r($request->file('lib_file'));exit;

        $book_type = new BookType;
        $book_type->Name = $request->input('Name');
        $book_type->Description = $request->input('Description');
        
        $book_type->save();

        return redirect()->back()->with('success', 'Subject/Category added Records have been updated');
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
        $book_type = BookType::find($id);

        $book_type->delete();

        return redirect()->back()->with('success', 'BookType Records have been updated');

    }
}
