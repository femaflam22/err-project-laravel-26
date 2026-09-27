@extends('layouts.app')

@section('content')
    <h1>Edit Todo</h1>

    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
        @csrf
        <input type="text" name="title" value="{{ $todo->title }}">
        <textarea name="description">{{ $todo->description }}</textarea>
        <button type="submit">Update</button>
    </form>
@endsection
