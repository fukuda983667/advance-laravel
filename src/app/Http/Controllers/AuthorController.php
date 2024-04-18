<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('index', ['authors' => $authors]);
    }

    public function add()
    {
        return view('add');
    }

    public function create(Request $request)
    {
        $form = $request->all();
        // formタグのnameとテーブルのカラム名が一致していればcreateメソッドの引数にそのまま渡せる
        // 一致していない場合は、一致するキー名の連想配列を作成して、$requestから値を一個ずつ格納。
        Author::create($form);
        // '/'にgetでアクセス。routs/web.phpに処理が回る。
        return redirect('/');
    }
}
