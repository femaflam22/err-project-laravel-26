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

    public function data()
    {
        return DataTables::of(Todo::query())
            ->editColumn('attachment', function ($row) {
                return $row->attachment
                    ? '<a href="' . asset('storage/' . $row->attachment) . '" target="_blank">Lihat</a>'
                    : '-';
            })
            ->addColumn('action', function ($row) {
                return '<a href="' . route('todos.edit', $row->id) . '">Edit</a>';
            })
            ->rawColumns(['attachment', 'action'])
            ->make(true);
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
            'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $path = $request->file('attachment')->store('attachments', 'public');

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'attachment' => $path,
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
