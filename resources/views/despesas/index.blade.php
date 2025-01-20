@extends('adminlte::page')

@section('title', 'Gerenciamento de Despesas Fixas')

@section('content_header')

@stop

@section('content')
    <div class="row mb-3">
        <div class="col">
            <!-- Botão para abrir o modal de criação -->
            <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#createDespesaModal">+ Nova Despesa</button>
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
        'itemsPerPage' => 30,
        'showTotal' => false,
        'valueColumnIndex' => 0,
    ])
        <thead class="table-primary">
            <tr>
                <th class="w-50">Descrição</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($despesasFixas as $despesa)
                <tr>
                    <td>{{ $despesa->descricao }}</td>
                    <td>{{ number_format($despesa->valor, 2, ',', '.') }}</td>
                    <td>
                        <!-- Botão Editar -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editDespesaModal{{ $despesa->id }}">
                            ✏️
                        </button>
                        <!-- Botão Excluir -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteDespesaModal{{ $despesa->id }}">
                            🗑️
                        </button>
                    </td>
                </tr>

                <!-- Modal Editar -->
                @include('despesas.modals.edit', ['despesa' => $despesa])

                <!-- Modal Excluir -->
                @include('despesas.modals.delete', ['despesa' => $despesa])
            @endforeach
        </tbody>
    @endcomponent

    <!-- Modal Criar -->
    @include('despesas.modals.create')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop