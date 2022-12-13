<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessToDo;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
        ]);

        // Create new one
        $task = Task::create($request->all());

        // Mark this todo item as completed in 5 minutes
        ProcessToDo::dispatch($task)
            ->delay(now()->addMinutes(5));

        // Update all except last 2 items
        Task::where('id', '<=', $task->id - 2)->update(['is_completed' => true]);

        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function update(Request $request, Task $todo)
    {
        $todo->fill($request->all());
        $todo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return Response
     */
    public function destroy(Task $todo)
    {
        $todo->delete();
    }
}
