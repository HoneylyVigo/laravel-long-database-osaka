<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        // Fetch categories from the database
        $categories = DB::table('categories')->get();

        return view('categories', ['categories' => $categories]);
    }
    public function categoryTasks($categoryId)
{
    // Retrieve tasks and user details from the database based on the category ID
    $tasks = DB::table('tasks')
        ->join('task_category', 'tasks.task_id', '=', 'task_category.task_id')
        ->join('users', 'tasks.user_id', '=', 'users.user_id')
        ->select('tasks.title', 'tasks.description', 'tasks.status', 'users.username')
        ->where('task_category.category_id', $categoryId)
        ->get();

    return view('category_tasks', ['tasks' => $tasks]);
}
}

