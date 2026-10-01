@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Daftar Todo</h1>

    <a href="{{ route('todos.create') }}" class="btn btn-primary mb-3">Tambah Todo</a>

    <ul class="list-group mb-4">
        @foreach($todos as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    {{ $todo->title }}
                    <span class="badge bg-{{ $item->status == 'Done' ? 'success' : ($item->status == 'Doing' ? 'warning' : 'secondary') }}">
                        {{ $item->status }}
                    </span>
                </div>

                <div class="btn-group">
                    <form action="{{ route('todos.updateStatus', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                            <option value="todo" {{ $item->status == 'todo' ? 'selected' : '' }}>Todo</option>
                            <option value="doing" {{ $item->status == 'doing' ? 'selected' : '' }}>Doing</option>
                            <option value="done" {{ $item->status == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </form>

                    <a href="{{ route('todos.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                    <form action="{{ route('todo.destroy', $item->id) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <h2 class="mb-3">Tabel DataTables</h2>

    <table id="todos-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Status</th>
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
                {data: 'status'},
                {data: 'attachment'},
                {data: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush
