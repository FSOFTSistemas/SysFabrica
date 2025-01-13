@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')

@stop

@section('content')
    <div class="row" style="margin-bottom: 2%">
        <div class="col">
            <a class="btn btn-primary" href="{{ route('empresas.create') }}">+ Nova Empresa</a>
        </div>
    </div>

    @component('components.data-table', [
        'responsive' => [
            [
                'responsivePriority' => 1,
                'targets' => 0,
            ],
            [
                'responsivePriority' => 2,
                'targets' => 1,
            ],
            [
                'responsivePriority' => 3,
                'targets' => 2,
            ],
            [
                'responsivePriority' => 4,
                'targets' => -1,
            ],
        ],
        'itemsPerPage' => 50,
        'showTotal' => false,
        'valueColumnIndex' => 4,
    ])
        <thead class="table-primary">
            <tr>
                <th>Razão Social</th>
                <th>Nome Fantasia</th>
                <th>Endereço</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empresas as $empresa)
                <tr>
                    <td>{{ $empresa->razao_social }}</td>
                    <td>{{ $empresa->nome_fantasia }}</td>
                    <td>{{ $empresa->logradouro ?? 'Não informado' }}</td>
                    <td>{{ $empresa->created_at->format('d/m/Y') }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#viewEmpresaModal{{ $empresa->id }}">
                            👁️
                        </button>
                        <a href="{{ route('empresas.edit', $empresa) }}" class="btn btn-warning btn-sm">
                            ✏️
                        </a>

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteEmpresaModal{{ $empresa->id }}">
                            🗑️
                        </button>
                    </td>
                </tr>

                <!-- Modal Visualizar Empresa -->
                <div class="modal fade" id="viewEmpresaModal{{ $empresa->id }}" tabindex="-1"
                    aria-labelledby="viewEmpresaModalLabel{{ $empresa->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="viewEmpresaModalLabel{{ $empresa->id }}">
                                    <i class="fas fa-building"></i> Detalhes da Empresa
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Coluna 1 -->
                                    <div class="col-md-6">
                                        <p><strong><i class="fas fa-id-card"></i> Razão Social:</strong>
                                            {{ $empresa->razao_social }}</p>
                                        <p><strong><i class="fas fa-clipboard-list"></i> Nome Fantasia:</strong>
                                            {{ $empresa->nome_fantasia ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-address-card"></i> CNPJ:</strong>
                                            {{ $empresa->cnpj ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-calendar-alt"></i> Cliente Desde:</strong>
                                            {{ $empresa->cliente_desde ? \Carbon\Carbon::parse($empresa->cliente_desde)->format('d/m/Y') : 'Não informado' }}
                                        </p>
                                        <p><strong><i class="fas fa-calendar-alt"></i> Data de Vencimento:</strong>
                                            {{ $empresa->data_vencimento ? \Carbon\Carbon::parse($empresa->data_vencimento)->format('d/m/Y') : 'Não informado' }}
                                        </p>
                                    </div>
                                    <!-- Coluna 2 -->
                                    <div class="col-md-6">
                                        <p><strong><i class="fas fa-map-marker-alt"></i> Endereço:</strong>
                                            {{ $empresa->logradouro ?? 'Não informado' }}, {{ $empresa->numero ?? '' }}</p>
                                        <p><strong><i class="fas fa-map"></i> Bairro:</strong>
                                            {{ $empresa->bairro ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-city"></i> Cidade:</strong>
                                            {{ $empresa->cidade ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-flag"></i> Estado:</strong>
                                            {{ $empresa->estado ?? 'Não informado' }}</p>
                                        <p><strong><i class="fas fa-envelope"></i> CEP:</strong>
                                            {{ $empresa->cep ?? 'Não informado' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <span class="text-muted">
                                    <small><i class="fas fa-clock"></i> Criado em:
                                        {{ $empresa->created_at->format('d/m/Y H:i') }}</small>
                                </span>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i> Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Excluir Empresa -->
                <div class="modal fade" id="deleteEmpresaModal{{ $empresa->id }}" tabindex="-1"
                    aria-labelledby="deleteEmpresaModalLabel{{ $empresa->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteEmpresaModalLabel{{ $empresa->id }}">Excluir Empresa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Tem certeza de que deseja excluir a empresa <strong>{{ $empresa->razao_social }}</strong>?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('empresas.destroy', $empresa) }}" method="POST">
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
