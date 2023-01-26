<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();
        $tasks = Task::latest()->get();
        $mode="create";
        return view("tasks.index", compact("tasks"));
    }

   /*  public function create() {
        // On retourne la vue "/resources/views/posts/edit.blade.php"
        return view("tasks.index");
    } */
    public function store(Request $request) {
        $this->validate($request, [
            'titre' => 'bail|string|max:255',
        ]);
        Task::create([
            "titre" => $request->titre,
            "etat" => 0
        ]);

//instance
      /*   $new_task = new Task();
        $new_task->titre = 'test';
        $new_task->etat = 0;
        $new_task->save(); */
            return redirect(route("tasks.index"));
    }
    public function edit(Task $task) {
        $tasks = Task::latest()->get();
       // dd($task);
        return view("tasks.index", compact("task" , "tasks"));
    }
    public function update(Request $request, Task $task) {

       
        $rules = [
            'titre' => 'bail|required|string|max:255',
        ];    
        $this->validate($request, $rules);
            $task->update([
            "titre" => $request->titre,

        ]);

        /* $t = Task::find($task->id);
        $t->titre =  $request->titre;
        $t->save(); */
    
        return redirect(route("tasks.index", $task));
    }
    public function destroy(Task $task) {

        $task->delete();
        return redirect(route('tasks.index'));
    }
    public function etat(Request $request,Task $task) {
      
        $task->update(["etat" => 1]);
       
        // recherche par id 
       
        $tasks_fini = Task::where('etat' , 1)->get();
       /* $task=new Task();
        $task->etat=1;
        $task->save(); */
         return redirect(route("tasks.index")); 
    }
}
