@extends('adminlte::page')

@section('title', 'Gerenciamento de Funcionários')

@section('content_header')
    
@stop

@section('content')
    <div class="row mb-2">
        <div class="col">
            <a class="btn btn-primary" href="{{ route('funcionarios.create') }}">
                <i class="fas fa-plus"></i> Novo Funcionário
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
                <th>Telefone</th>
                <th>Comissão</th>
                <th>Data de Admissão</th>
                <th>Situação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $funcionario)
                <tr>
                    <td>{{ $funcionario->nome }}</td>
                    <td>{{ $funcionario->telefone }}</td>
                    <td>{{ number_format($funcionario->comissao, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($funcionario->admissao)->format('d/m/Y') }}</td>
                    <td>{{ $funcionario->situacao == 1 ? 'Ativo' : 'Inativo' }}</td>
                    <td>
                        <!-- Botão Visualizar -->
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#viewFuncionarioModal{{ $funcionario->id }}">
                            👁️
                        </button>
                        <!-- Botão Editar -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editFuncionarioModal{{ $funcionario->id }}">
                            ✏️
                        </button>
                        <!-- Botão Excluir -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteFuncionarioModal{{ $funcionario->id }}">
                            🗑️
                        </button>
                    </td>
                </tr>

                <!-- Modal Visualizar -->
                @include('funcionarios.modals.view', ['funcionario' => $funcionario])

                <!-- Modal Editar -->
                @include('funcionarios.modals.edit', ['funcionario' => $funcionario])

                <!-- Modal Excluir -->
                @include('funcionarios.modals.delete', ['funcionario' => $funcionario])
            @endforeach
        </tbody>
    @endcomponent

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop
