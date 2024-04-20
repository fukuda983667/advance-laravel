<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

use App\Http\Requests\AuthorRequest;

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

    // AuthorRequestクラスで渡ってきた引数$requestを宣言した時点で、バリデーションルールに適合するかを判定される。
    // バリデーションルールに不適合であれば'errors'を返り値として現在表示中のviewファイルにリダイレクトする。
    public function create(AuthorRequest $request)
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
        // /edit?id=1とクライアントからリクエストが送られると、
        // Request $requestにはGETでキーがid、値が1の連想配列が格納される
        // findメソッドでデータベースから指定のidと一致するレコードを取得
        $author = Author::find($request->id);
        // formにはクエリ文字(id)と一致するレコードが格納された状態でedit.blade.phpを呼び出す。
        return view('edit', ['form' => $author]);
    }

    public function update(AuthorRequest $request)
    {
        $form = $request->all();
        // @csrfにより、csrf対策用のトークンが生成されるため、削除。連想配列の子要素が増えている状態
        unset($form['_token']);
        // レコードを検索、更新
        Author::find($request->id)->update($form);
        return redirect('/');
    }

    public function delete(Request $request)
    {
        $author = Author::find($request->id);
        return view('delete', ['author' => $author]);
    }

    public function remove(Request $request)
    {
        Author::find($request->id)->delete();
        return redirect('/');
    }

    public function find()
    {
        return view('find', ['input' => '']);
    }

    public function search(Request $request)
    {
        // $item = Author::where('name', 'LIKE',"%{$request->input}%")->first(); 部分一致
        $item = Author::where('name', $request->input)->first();
        // paramは二次元配列。二次元配列をviewに渡すときは可読性の観点から$paramの形で返す。
        $param = [
            // 検索欄に入力した文字が残るようにするため
            'input' => $request->input,
            // レコードが格納されてる
            'item' => $item
        ];
        return view('find', $param);
    }

    // Author $authorで引数を用意しており、web.phpの{author}(数字)と一致するIDをもつレコードが
    // $authorに格納される。という仕様になっている。「暗黙の結合」。動きとしてはeditメソッドに近い。
    // このメソッドはid検索のようなもの
    public function bind(Author $author)
    {
        $data = [
            'item'=>$author,
        ];
        return view('author.binds', $data);
    }

    public function verror()
    {
        return view('verror');
    }
}
