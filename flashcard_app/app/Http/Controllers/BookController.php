<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function index(){
        return view('book.index',['books'=>Book::all()]);
    }

    public function show(Book $book){
        return view('book.show', compact('book'));
    }
}
