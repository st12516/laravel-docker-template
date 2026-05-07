<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest; // バリデーション
use App\Todo;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function index()
    {
        // $todo = new Todo();
        $todos = $this->todo->all();
        // dd($todos);

        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        // dd('新規作成画面のルート実行！');
        return view('todo.create');
    }

    // public function store(Request $request)
    public function store(TodoRequest $request)
    {
        $inputs = $request->all();
        // dd($inputs);
        // 1. todosテーブルの1レコードを表すTodoクラスをインスタンス化
        // $todo = new Todo();
        // 2. Todoインスタンスのカラム名のプロパティに保存したい値を代入、連想配列
        $this->todo->fill($inputs);
        // 3. Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行
        $this->todo->save();
        return redirect()->route('todo.index');
    }

    public function show($id)
    {
        // dd($id);
        // $model = new Todo();
        $todo = $this->todo->find($id);
        // dd($todo);
        return view('todo.show', ['todo' => $todo]);
    }

    // TODO: ルートパラメータを引数に受け取る
    public function edit($id)
    {
        // TODO: 編集対象のレコードの情報を持つTodoモデルのインスタンスを取得
        $todo = $this->todo->find($id);
        // dd($todo);
        return view('todo.edit', ['todo' => $todo]);
    }

    // public function update(Request $request, $id) // 第1引数: リクエスト情報の取得　第2引数: ルートパラメータの取得
    public function update(TodoRequest $request, $id)
    {
        // TODO: リクエストされた値を取得
        $inputs = $request->all();
        // dd($inputs);
        // TODO: 更新対象のデータを取得
        $todo = $this->todo->find($id);
        // TODO: 更新したい値の代入とUPDATE文の実行
        $todo->fill($inputs)->save();

        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
        // dd('削除のルート実行！');
        $todo = $this->todo->find($id);
        $todo->delete();

        return redirect()->route('todo.index');
    }
}