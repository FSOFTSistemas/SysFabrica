@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
   
@stop

@section('content')
    <div class="row mb-2">
        <div class="col">
            <a class="btn btn-primary" href="{{ route('clientes.create') }}">+ Novo Cliente</a>
        </div>
    </div>

    @component('components.data-table', [
        'responsive' => [
            ['responsivePriority' => 1, 'targets' => 0],
            ['responsivePriority' => 2, 'targets' => 1],
            ['responsivePriority' => 3, 'targets' => 2],
            ['responsivePriority' => 4, 'targets' => -1],
        ],
        'itemsPerPage' => 50,
        'showTotal' => false,
        'valueColumnIndex' => 4,
    ])
        <thead class="table-primary">
            <tr>
                <th>Razão Social</th>
                <th>Nome Fantasia</th>
                <th>CNPJ</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->razaoSocial }}</td>
                    <td>{{ $cliente->nomeFantasia }}</td>
                    <td>{{ $cliente->cnpj }}</td>
                    <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#viewClienteModal{{ $cliente->id }}">
                            👁️
                        </button>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm">
                            ✏️
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteClienteModal{{ $cliente->id }}">
                            🗑️
                        </button>
                    </td>
                </tr>

                <!-- Modal Visualizar Cliente -->
                <div class="modal fade" id="viewClienteModal{{ $cliente->id }}" tabindex="-1"
                    aria-labelledby="viewClienteModalLabel{{ $cliente->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Cabeçalho do Modal -->
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="viewClienteModalLabel{{ $cliente->id }}">
                                    <i class="fas fa-user"></i> Detalhes do Cliente
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Corpo do Modal -->
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Coluna 1 -->
                                    <div class="col-md-6">
                                        <p><strong><i class="fas fa-id-card"></i> Razão Social:</strong>
                                            {{ $cliente->razaoSocial ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-clipboard-list"></i> Nome Fantasia:</strong>
                                            {{ $cliente->nomeFantasia ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-cogs"></i> CNPJ:</strong>
                                            {{ $cliente->cnpj ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-calendar-alt"></i> Criado em:</strong>
                                            {{ $cliente->created_at ? \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y H:i') : 'Não informado' }}
                                        </p>
                                    </div>
                                    <!-- Coluna 2 -->
                                    <div class="col-md-6">
                                        <p><strong><i class="fas fa-map-marker-alt"></i> Endereço:</strong>
                                            {{ $cliente->endereco->logradouro ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-city"></i> Bairro:</strong>
                                            {{ $cliente->endereco->bairro ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-map"></i> Cidade:</strong>
                                            {{ $cliente->endereco->cidade ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-flag"></i> Estado:</strong>
                                            {{ $cliente->endereco->estado ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-envelope"></i> CEP:</strong>
                                            {{ $cliente->endereco->cep ?? 'Não informado' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Rodapé do Modal -->
                            <div class="modal-footer d-flex justify-content-between">
                                <span class="text-muted">
                                    <small><i class="fas fa-clock"></i> Criado em:
                                        {{ $cliente->created_at->format('d/m/Y H:i') }}</small>
                                </span>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i> Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Excluir Cliente -->
                <div class="modal fade" id="deleteClienteModal{{ $cliente->id }}" tabindex="-1"
                    aria-labelledby="deleteClienteModalLabel{{ $cliente->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteClienteModalLabel{{ $cliente->id }}">Excluir Cliente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Tem certeza de que deseja excluir o cliente <strong>{{ $cliente->razaoSocial }}</strong>?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    @endcomponent
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    {{-- Personalize os scripts JS aqui --}}
@stop
