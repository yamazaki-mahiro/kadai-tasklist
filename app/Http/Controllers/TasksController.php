<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            
            $user = \Auth::user();
            $tasks = Task::where('user_id',$user->id)->get();
            
            $data = [
                    'user' => $user,
                    'tasks' => $tasks,
                ];

            return view('tasks.index', [     // 追加
                'tasks' => $tasks,        // 追加
        ], $data);
        }
        return redirect('/');
                                  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        if (\Auth::check()) {
            $task = new Task;
            // タスク作成ビューを表示
            return view('tasks.create', [
                'task' => $task,
            ]);
       }
       return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (\Auth::check()) {
            $request->validate([
                'content' => 'required|max:255',
                'status' => 'required|max:10',
            ]);
            $user = \Auth::user();
            $userId = $user->id;
            $task = new Task([
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => $userId,
            ]);
            $task->save();
            return redirect('/top');
         }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        if (\Auth::check()) {
            $task = Task::findOrFail($id);
            $user = \Auth::user();
            $userId = $user->id;
            if(!($task->user_id == $userId)){
                return redirect('/top');
            }
            return view('tasks.show', [
                'task' => $task,
            ]);
        } 
       return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (\Auth::check()) {
            $task = Task::findOrFail($id);
            $user = \Auth::user();
            $userId = $user->id;
            if(!($task->user_id == $userId)){
                return redirect('/top');
            }
            return view('tasks.edit', [
                'task' => $task,
            ]);
       }
       return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        if (\Auth::check()) {
            $request->validate([
                'content' => 'required|max:255',
                'status' => 'required|max:10',
            ]);
            $task = Task::findOrFail($id);
            $user = \Auth::user();
            $userId = $user->id;
            if(!($task->user_id == $userId)){
                return redirect('/top');
            }
            $task->content = $request->content;
            $task->status = $request->status;
            $task->save();
            return redirect('/top');
        }
        return redirect('/');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    { 
        if (\Auth::check()) {
            $task = Task::findOrFail($id);
            $user = \Auth::user();
            $userId = $user->id;
            if(!($task->user_id == $userId)){
                return redirect('/top');
            }
            $task->delete();
            return redirect('/top');
        }
        return redirect('/');
    }

    public function checkAuth($id)
    { 
        if (\Auth::check()) {
            return redirect('/top');
        }
    }

}
