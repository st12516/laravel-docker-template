<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 追記

class Todo extends Model
{
    use SoftDeletes; // 追記

    protected $table = 'todos';

    protected $fillable = [
        'content',
    ];
}

// ToDoの削除時にdeleted_atカラムに削除日時を格納して更新
// ToDoの取得時にdeleted_atカラムがNULLのレコードのみという条件を追加