@extends('layout')

@section('main')
    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('usuarios.index') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });
        });

    </script>
@endsection
