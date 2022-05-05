<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ToDoList extends Component
{
    public string $taskTitle = '';

    protected $rules = [
      'taskTitle' => 'required|max:255'
    ];
    public function render()
    {
        return view('livewire.to-do-list', [
            'tasks'=>Task::all() //ordering here
        ])->extends('layouts.app');
    }

    public function addTask($id){
        $this->validateOnly('taskTitle');

        if (Auth::user()){
            Task::create([
                'title' => $this->taskTitle,
                'user_id' => $id
            ]);
            $this->reset('taskTitle');
        }

    }
    public function deleteTask(Task $task){
        if (Auth::user()->id == $task->user->id OR Auth::user()->isAdmin()  ){
            $task->delete();
            Session::flash('todo_mess', 'Allright '. Auth::user()->name . ', this task was deleted');
        }else{
            Session::flash('todo_mess', 'Sorry, you can only delete you own tasks ' . Auth::user()->name );

        }
    }
    public function deleteAllTasks(){
        if (Auth::user()->isAdmin() ){
            $tasks = Task::all();
            foreach ($tasks as $task){
                $task->delete();
            }
            Session::flash('todo_mess', 'Allright Admin '. Auth::user()->name . ' you have deleted everyones tasks, hope you are proud of yourself');
        }else{
            Session::flash('todo_mess', 'Sorry, '. Auth::user()->name .' only the Administrator of this page can delete everything'  );

        }
    }
}
