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

    public function edit(Request $request)
    {
        // /edit?id=1とクライアントからリクエストを送ると、
        // Request $requestにはGETでキーがid、値が1の連想配列が格納される
        // findメソッドでデータベースから指定のidと一致するレコードを取得
        $author = Author::find($request->id);
        // クエリ文字のレコードが入力された状態でedit.blade.phpを呼び出す。
        return view('edit', ['form' => $author]);
    }

    public function update(Request $request)
    {
        $form = $request->all();
        // @csrfにより、csrf対策用のトークンが生成されるため、削除。連想配列の子要素が増えている状態
        unset($form['_token']);
        // レコードを検索、更新
        Author::find($request->id)->update($form);
        return redirect('/');
    }
}
