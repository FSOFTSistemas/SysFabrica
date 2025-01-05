@extends('adminlte::page')

@section('title', 'Gerenciamento de Produtos')

@section('content_header')

@stop

@section('content')
    <div class="row mb-3">
        <div class="col">
            <!-- Botão para abrir o modal de criação -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProdutoModal">+ Novo Produto</button>
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
                <th>Preço Custo</th>
                <th>Preço Venda</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{ $produto->descricao }}</td>
                    <td>R$ {{ number_format($produto->precocusto, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->precoVenda, 2, ',', '.') }}</td>
                    <td>{{ $produto->status }}</td>
                    <td>
                        <a href="{{ route('receitas.index', ['produto_id' => $produto->id]) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-cogs"></i>
                        </a>
                        <!-- Botão Visualizar -->
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#viewProdutoModal{{ $produto->id }}">
                            👁️
                        </button>
                        <!-- Botão Editar -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editProdutoModal{{ $produto->id }}">
                            ✏️
                        </button>
                        <!-- Botão Excluir -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteProdutoModal{{ $produto->id }}">
                            🗑️
                        </button>
                    </td>
                </tr>

                <!-- Modal Visualizar -->
                @include('produtos.modals.view', ['produto' => $produto])

                <!-- Modal Editar -->
                @include('produtos.modals.edit', ['produto' => $produto])

                <!-- Modal Excluir -->
                @include('produtos.modals.delete', ['produto' => $produto])
            @endforeach
        </tbody>
    @endcomponent

    <!-- Modal Criar -->
    @include('produtos.modals.create')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop
