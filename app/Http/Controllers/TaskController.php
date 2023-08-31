<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $tasks = Task::
        where(function($q) use($data){
            if(isset($data['employee_id'])){
                $q->where('employee_id',$data['employee_id']);
            }
            if(isset($data['status'])){
                $q->where('status',$data['status']);
            }
        })->paginate(15);
        $employees = Employee::all();
        return view('task.index',[
            'tasks' => $tasks,
            'employees' => $employees,
            'getdata'   => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = Task::create($request->post());
        $email = 'admin@otaskit.com';
        Mail::send(['html' => 'email.taskcreated'],['title' => $request->post('title')],
            function ($message) use ($email) {
            $message->to($email)
            ->from('norepy@otaskit.com') 
            ->subject('Task Created');
        });
        return response()->json([
            'status' => 'success',
            'message'=>'Task Created Successfully!!',
            'category'=>$task
        ]);        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $data = $request->all();
        $task = Task::find($id);       

        if($data['status'] == 'Done'){
            $total_time = $task->created_at->diffInMinutes(\Carbon\Carbon::now());
            if($total_time <= 5){
                return response()->json([
                    'status' => 'error',
                    'message'=>'Need to Completed task only after 5 Minutes!',
                ]);
            }
        }

        if($data['status'] == 'Assigned'){
            $employee = Employee::where('id',$data['employee_id'])->first();
            $email = $employee->email;
            Mail::send(['html' => 'email.taskassigned'],['name' => $employee->name,'title' => $data['title']],
                function ($message) use ($email) {
                $message->to($email)
                ->from('admin@otaskit.com') 
                ->subject('Task Assigned');
            });
        }

        $task->update($request->all());

        return response()->json([
            'status' => 'success',
            'message'=>'Task Updated!',
            'category'=>$task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return response()->json('Task deleted!');
    }

    public function log(){
        echo 'Hello';
    }
}
