@extends('adminlte::page')

@section('title', 'Gestão de Usuários')

@section('content_header')

@stop

@section('content')
    <div class="row mb-3">
        <div class="col text-right">
            <!-- Botão estilizado para criar um novo usuário -->
            <a href="{{ route('usuarios.create') }}" class="btn btn-success">
                <i class="fas fa-user-plus"></i> Novo Usuário
            </a>
        </div>
    </div>

    <!-- DataTable Customizado -->
    @component('components.data-table', [
        'responsive' => [
            ['responsivePriority' => 1, 'targets' => 0],
            ['responsivePriority' => 2, 'targets' => 1],
            ['responsivePriority' => 3, 'targets' => 2],
            ['responsivePriority' => 4, 'targets' => -1],
        ],
        'itemsPerPage' => 10,
        'showTotal' => false,
        'valueColumnIndex' => 3,
    ])
        <thead class="table-primary">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <!-- Botão Visualizar -->
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#viewUserModal{{ $usuario->id }}">
                            👁️
                        </button>
                        <!-- Botão Editar -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editUserModal{{ $usuario->id }}">
                            ✏️
                        </button>
                        <!-- Botão Excluir -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteUserModal{{ $usuario->id }}">
                            🗑️
                        </button>
                    </td>
                </tr>

                <!-- Modal Visualizar -->
                @include('usuarios.modals.view', ['usuario' => $usuario])

                <!-- Modal Editar -->
                @include('usuarios.modals.edit', ['usuario' => $usuario])

                <!-- Modal Excluir -->
                @include('usuarios.modals.delete', ['usuario' => $usuario])
            @endforeach
        </tbody>
    @endcomponent
@stop

