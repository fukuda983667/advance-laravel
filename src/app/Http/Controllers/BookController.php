<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $items = Book::all();
        // $itemsは二次元配列
        return view('book.index', ['items'=>$items]);
    }

    public function add()
    {
        return view('book.add');
    }

    public function create(Request $request){
        // Bookモデルのrules(バリデーションルール)を参照して合致するか判定。
        $this->validate($request, Book::$rules);
        $form = $request->all();
        Book::create($form);
        return redirect('/book');
    }
}