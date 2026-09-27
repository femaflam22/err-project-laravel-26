@extends('layouts.app')

@section('content')
    <h1>Tambah Todo</h1>

    <form action="{{ route('todos.store') }}" method="POST">
        <input type="text" name="title" placeholder="Judul">
        <textarea name="description" placeholder="Deskripsi"></textarea>
        <button type="submit">Simpan</button>
    </form>
@endsection
