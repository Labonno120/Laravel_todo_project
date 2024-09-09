<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController1 extends Controller
{
    public function index()
    {
        // Fetch todos from the session, or initialize with an empty array
        $todos = session()->get('todos', []);
        $total = count($todos);

        return view('admin.todo.home', compact(['todos', 'total']));
    }

    public function create()
    {
        return view('admin.todo.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'todo' => 'required',
            'due_date' => 'required',
            'status' => 'required|in:Incomplete,In Progress,Complete', // Ensure status is one of the predefined options
        ]);

        // Fetch the current todos from the session
        $todos = session()->get('todos', []);

        // Add the new todo to the session
        $newTodo = [
            'todo' => $validation['todo'],
            'due_date' => $validation['due_date'],
            'status' => $validation['status'],
        ];

        // Use array_push to maintain numeric keys
        $todos[] = $newTodo;

        // Save the updated todos list to the session
        session()->put('todos', $todos);

        session()->flash('success', 'Todo added successfully');
        return redirect(route('admin.todo.index'));
    }

    public function edit($key)
    {
        // Fetch todos from the session
        $todos = session()->get('todos', []);

        // Check if the todo exists using the key
        if (!isset($todos[$key])) {
            session()->flash('error', 'Todo not found');
            return redirect(route('admin.todo.index'));
        }

        // Get the specific todo by key
        $todo = $todos[$key];

        return view('admin.todo.update', compact('todo', 'key'));
    }

    public function delete($key)
    {
        // Fetch todos from the session
        $todos = session()->get('todos', []);

        // Check if the todo exists using the key
        if (!isset($todos[$key])) {
            session()->flash('error', 'Todo not found');
            return redirect(route('admin.todo.index'));
        }

        // Remove the todo by key
        unset($todos[$key]);

        // Re-index the array and update the session
        session()->put('todos', array_values($todos));

        session()->flash('success', 'Todo deleted successfully');
        return redirect(route('admin.todo.index'));
    }

    public function update(Request $request, $key)
    {
        $validation = $request->validate([
            'todo' => 'required',
            'due_date' => 'required',
            'status' => 'required|in:Incomplete,In Progress,Complete', // Ensure status is one of the predefined options
        ]);

        // Fetch todos from the session
        $todos = session()->get('todos', []);

        // Check if the todo exists using the key
        if (!isset($todos[$key])) {
            session()->flash('error', 'Todo not found');
            return redirect(route('admin.todo.index'));
        }

        // Update the todo using the key
        $todos[$key]['todo'] = $validation['todo'];
        $todos[$key]['due_date'] = $validation['due_date'];
        $todos[$key]['status'] = $validation['status'];

        // Save the updated todos list back to the session
        session()->put('todos', $todos);

        session()->flash('success', 'Todo updated successfully');
        return redirect(route('admin.todo.index'));
    }
}
