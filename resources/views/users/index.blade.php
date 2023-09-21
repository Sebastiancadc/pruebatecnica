@extends('layouts.app')

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Crear
    </button>
    @include('users.modalcreate')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Rol</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                         <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#exampleModalupdate{{ $user->id }}">
                            Editar
                        </button>
                        @include('users.modalupdate')
                        @if (auth()->user()->role != 'Usuario' || auth()->user()->role != 'Gestor')
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#exampleModaldelete{{ $user->id }}">
                        Eliminar
                    </button>
                    @include('users.modaldelete')
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
