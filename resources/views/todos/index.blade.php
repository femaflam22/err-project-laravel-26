@extends('layouts.app')

@section('content')
    <h1>Daftar Todo</h1>

    <a href="{{ route('todos.create') }}">Tambah Todo</a>

    <ul>
        @foreach($todos as $item)
            <li>
                {{ $todo->title }}

                <a href="{{ route('todos.edit', $item->id) }}">Edit</a>

                <form action="{{ route('todo.destroy', $item->id) }}" method="POST" style="display:inline">
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
