<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\UserCard;
use Auth;

class BookController extends Controller
{
    public function index(){
        return view('book.index',['books' => Book::all()]);
    }

    public function show(Book $book){
        return view('book.show', ['book' => $book, 'user_cards' => Auth::user()->cards, 'lerning_levels' => UserCard::LERNING_LEVELS]);
    }
}
