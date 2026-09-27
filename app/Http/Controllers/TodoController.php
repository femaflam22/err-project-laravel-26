<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todo = Todo::all();
        return view('todos.index', compact('todo'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|string',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => false,
        ]);

        return redirect()->route('todos.index');
    }

    public function edit($id)
    {
        $todo = Todo::find($id);
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'desc' => 'nullable|string',
        ]);

        $todo = Todo::find($id);
        $todo->update($request->all());

        return redirect()->route('todos.index');
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delet();

        return redirect()->route('todos.index');
    }
}
