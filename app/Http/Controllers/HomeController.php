<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }
    
    public function home(){

        // $this->middleware('verified');
        
        return view('visitor');
    }

    public function books_page()
    {
        $book_types = BookType::orderBy('Name')->get();
        return view('pages.books_page')->with(['book_types' => $book_types]);
    }
}
