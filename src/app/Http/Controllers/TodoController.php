<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request)
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
}