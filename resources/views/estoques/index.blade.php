@extends('adminlte::page')

@section('title', 'Gerenciamento de Estoque')

@section('content_header')

@stop

@section('content')
    <div class="row mb-3">
        <div class="col">
            <!-- Botão para abrir o modal de criação -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEstoqueModal">+ Novo Estoque</button>
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
                <th>Produto</th>
                <th>Entradas</th>
                <th>Saídas</th>
                <th>Estoque Atual</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estoques as $estoque)
                <tr>
                    <td>{{ $estoque->produto->descricao }}</td>
                    <td>{{ number_format($estoque->entradas, 2, ',', '.') }}</td>
                    <td>{{ number_format($estoque->saidas, 2, ',', '.') }}</td>
                    <td>{{ number_format($estoque->estoque_atual, 2, ',', '.') }}</td>
                    <td>
                        <!-- Botão Visualizar -->
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#viewEstoqueModal{{ $estoque->id }}">
                            👁️
                        </button>
                        <!-- Botão Editar -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editEstoqueModal{{ $estoque->id }}">
                            ✏️
                        </button>
                        <!-- Botão Excluir -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteEstoqueModal{{ $estoque->id }}">
                            🗑️
                        </button>
                    </td>
                </tr>

                <!-- Modal Visualizar -->
                @include('estoques.modals.view', ['estoque' => $estoque])

                <!-- Modal Editar -->
                @include('estoques.modals.edit', ['estoque' => $estoque])

                <!-- Modal Excluir -->
                @include('estoques.modals.delete', ['estoque' => $estoque])
            @endforeach
        </tbody>
    @endcomponent

    <!-- Modal Criar -->
    @include('estoques.modals.create')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop