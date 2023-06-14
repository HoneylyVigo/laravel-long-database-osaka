<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();

        return view('categories', ['categories' => $categories]);
    }
    public function categoryTasks($categoryId)
    {
        $tasks = DB::table('tasks')
            ->join('task_category', 'tasks.task_id', '=', 'task_category.task_id')
            ->join('users', 'tasks.user_id', '=', 'users.user_id')
            ->select('tasks.title', 'tasks.description', 'tasks.status', 'users.username')
            ->where('task_category.category_id', $categoryId)
            ->get();

        return view('category_tasks', ['tasks' => $tasks]);
    }
}
