<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tasks = Task::orderBy('task_priority')->paginate(5);

      return view('tasks.index',compact('tasks'))
          ->with('i', (request()->input('page', 1) - 1) * 5);        //
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'task_name' => 'required|unique:tasks',
        ]);


        Task::create($request->all());

        return redirect()->route('tasks.index')
            ->with('success','Task created successfully.');

    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show',compact('task'));
    }









    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id )
    {

      $tasks = Task::orderBy('task_priority')->paginate(5);

      $tasktoedit = Task::where('id', $id)->first();
      return view('tasks.index',compact('tasks','tasktoedit'))
          ->with('i', (request()->input('page', 1) - 1) * 5);

    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //

        $request->validate([
            'task_name' => 'required|unique:tasks,task_name,'.$task->id,
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')
          ->with('success','Task updated successfully');
    }


    public function sort(Request $request)

    {

        $tasks = Task::all();


        foreach ($tasks as $task) {

            foreach ($request->order as $order) {

                if ($order['id'] == $task->id) {

                    $task->update(['task_priority' => $order['position']]);

                }

            }

        }



        return response('Update Successfully.', 200);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();

        return redirect()->route('tasks.index')
          ->with('success','Task deleted successfully');
    }
}
