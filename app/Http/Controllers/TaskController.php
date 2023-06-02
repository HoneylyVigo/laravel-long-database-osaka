<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function addComment(Request $request)
    {
        $taskID = $request->input('task_id');
        $commentText = $request->input('comment_text');
        $userID = session('user_id');

        $data = [
            'task_id' => $taskID,
            'user_id' => $userID,
            'comment_text' => $commentText
        ];

        DB::table('comments')->insert($data);

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $task = DB::table('Tasks')->where('task_id', $id)->first();

        if ($task) {
            return view('edit', compact('task'));
        } else {
            return "Task not found.";
        }
    }

    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $status = $request->input('status');

        $data = [
            'title' => $title,
            'description' => $description,
            'status' => $status
        ];

        DB::table('Tasks')->where('task_id', $id)->update($data);

        return redirect()->route('home');
    }

    public function delete($id)
    {
        DB::table('Tasks')->where('task_id', $id)->delete();

        return redirect()->route('home');
    }
        public function create()
    {
        // Fetch categories from the database
        $categories = DB::table('categories')->get();

        return view('add', ['categories' => $categories]);
    }

    public function store(Request $request)
    {

        // Get the user ID
        $user_id = Session::get('user_id');

        // Get the task details from the form
        $title = $request->input('title');
        $description = $request->input('description');
        $status = $request->input('status');
        $categories = $request->input('categories');

        // Insert the task details into the tasks table
        $taskID = DB::table('tasks')->insertGetId([
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'user_id' => $user_id
        ]);

        // Insert the task-category relationship into the task_category table
        foreach ($categories as $categoryID) {
            DB::table('task_category')->insert([
                'task_id' => $taskID,
                'category_id' => $categoryID
            ]);
        }

        return redirect()->route('index');
    }


}
