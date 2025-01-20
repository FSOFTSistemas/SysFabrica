@extends('adminlte::page')

@section('title', 'Gerenciamento de Ordens de Produção')

@section('content_header')

@stop

@section('content')
    <div class="row mb-3">
        <div class="col">
            <!-- Botão para abrir o modal de criação -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createOrdemModal">+ Nova Ordem de Produção</button>
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
        'valueColumnIndex' => 4,
    ])
        <thead class="table-primary">
            <tr>
                <th>Funcionário</th>
                <th>Produto</th>
                <th>Produção Estimada</th>
                <th>Produção Real</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ordens as $ordem)
                <tr>
                    <td>{{ $ordem->funcionario->nome }}</td>
                    <td>{{ $ordem->produto->descricao }}</td>
                    <td>{{ number_format($ordem->producao_estimada, 2, ',', '.') }}</td>
                    <td>{{ number_format($ordem->producao_real, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($ordem->sattus) }}</td>
                    <td>
                        <!-- Botão Visualizar -->
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#viewOrdemModal{{ $ordem->id }}">
                            👁️
                        </button>
                        <!-- Botão Editar -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editOrdemModal{{ $ordem->id }}">
                            ✏️
                        </button>
                        <!-- Botão Excluir -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteOrdemModal{{ $ordem->id }}">
                            🗑️
                        </button>
                    </td>
                </tr>

                <!-- Modal Editar -->
                @include('producao.modals.edit', ['ordem' => $ordem])

                <!-- Modal Excluir -->
                @include('producao.modals.delete', ['ordem' => $ordem])
            @endforeach
        </tbody>
    @endcomponent

    <!-- Modal Criar -->
    @include('producao.modals.create',['funcionarios' => $funcionarios])

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop