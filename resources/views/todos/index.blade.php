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

    <h2>Tabel DataTables</h2>

    <table id="todos-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Lampiran</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#todos-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('todos.data') }}',
            columns: [
                {data: 'id'},
                {data: 'judul'},
                {data: 'attachment'},
                {data: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush
