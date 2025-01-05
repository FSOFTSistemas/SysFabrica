@extends('adminlte::page')

@section('title', 'Gerenciamento de Receitas')

@section('content_header')
    
@stop

@section('content')
<h6>Receitas do Produto {{ $produto->descricao}} </h6>
    <div class="row mb-3">
        <div class="col">
            <!-- Botão para abrir o modal de criação -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createReceitaModal">Adicionar igrediente</button>
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
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Produto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receitas as $receita)
                <tr>
                    <td>{{ $receita->descricao }}</td>
                    <td>{{ number_format($receita->qtd, 2, ',', '.') }}</td>
                    <td>{{ $receita->produto->descricao }}</td>
                    <td>
                        <!-- Botão Editar -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editReceitaModal{{ $receita->id }}">
                            ✏️
                        </button>
                        <!-- Botão Excluir -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteReceitaModal{{ $receita->id }}">
                            🗑️
                        </button>
                    </td>
                </tr>

               
                <!-- Modal Editar Receita -->
                @include('receitas.modals.edit', ['receita' => $receita])

                <!-- Modal Excluir Receita -->
                @include('receitas.modals.delete', ['receita' => $receita])
            @endforeach
        </tbody>
    @endcomponent

    <!-- Modal Criar Receita -->
    @include('receitas.modals.create')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop