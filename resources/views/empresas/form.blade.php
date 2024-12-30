@extends('adminlte::page')

@section('title', isset($empresa) ? 'Editar Empresa' : 'Nova Empresa')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ isset($empresa) ? 'Atualizar Empresa' : 'Cadastrar Empresa' }}</h3>
                </div>
                <form action="{{ isset($empresa) ? route('empresas.update', $empresa) : route('empresas.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($empresa))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        {{-- CNPJ --}}
                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj"
                                name="cnpj" value="{{ old('cnpj', $empresa->cnpj ?? '') }}"
                                placeholder="Informe o CNPJ da empresa" required>
                            @error('cnpj')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- Razão Social --}}
                        <div class="form-group">
                            <label for="razao_social">Razão Social</label>
                            <input type="text" class="form-control @error('razao_social') is-invalid @enderror"
                                id="razao_social" name="razao_social"
                                value="{{ old('razao_social', $empresa->razao_social ?? '') }}"
                                placeholder="Informe a razão social da empresa" required>
                            @error('razao_social')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Nome Fantasia --}}
                        <div class="form-group">
                            <label for="nome_fantasia">Nome Fantasia</label>
                            <input type="text" class="form-control @error('nome_fantasia') is-invalid @enderror"
                                id="nome_fantasia" name="nome_fantasia"
                                value="{{ old('nome_fantasia', $empresa->nome_fantasia ?? '') }}"
                                placeholder="Informe o nome fantasia da empresa">
                            @error('nome_fantasia')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- Inscrição Estadual --}}
                        <div class="form-group">
                            <label for="ie">Inscrição Estadual (IE)</label>
                            <input type="text" class="form-control @error('ie') is-invalid @enderror" id="ie"
                                name="ie" value="{{ old('ie', $empresa->ie ?? '') }}"
                                placeholder="Informe a Inscrição Estadual">
                            @error('ie')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Logo --}}
                        <div class="form-group">
                            <label for="path_logo">Logo da Empresa</label>
                            <input type="file" class="form-control-file @error('path_logo') is-invalid @enderror"
                                id="path_logo" name="path_logo">
                            @if (isset($empresa->path_logo))
                                <small>Logo atual:</small>
                                <div>
                                    <img src="{{ asset($empresa->path_logo) }}" alt="Logo" class="img-thumbnail"
                                        style="max-height: 150px;">
                                </div>
                            @endif
                            @error('path_logo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Endereço --}}
                        <div class="form-group">
                            <label for="endereco_id">Endereço</label>
                            <div class="input-group">
                                <select class="form-control @error('endereco_id') is-invalid @enderror" id="endereco_id"
                                    name="endereco_id" required>
                                    <option value="">Selecione um endereço</option>
                                    @foreach ($enderecos as $endereco)
                                        <option value="{{ $endereco->id }}"
                                            {{ old('endereco_id', $empresa->endereco_id ?? '') == $endereco->id ? 'selected' : '' }}>
                                            {{ $endereco->logradouro }}, {{ $endereco->numero }} -
                                            {{ $endereco->bairro }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                                    data-target="#modalEndereco">
                                    Adicionar Novo
                                </button>
                            </div>
                            @error('endereco_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                                required>
                                <option value="ativo"
                                    {{ old('status', $empresa->status ?? '') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="inativo"
                                    {{ old('status', $empresa->status ?? '') == 'inativo' ? 'selected' : '' }}>Inativo
                                </option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Data de Vencimento --}}
                        <div class="form-group">
                            <label for="data_vencimento">Data de Vencimento</label>
                            <input type="date" class="form-control @error('data_vencimento') is-invalid @enderror"
                                id="data_vencimento" name="data_vencimento"
                                value="{{ old('data_vencimento', $empresa->data_vencimento ?? '') }}" required>
                            @error('data_vencimento')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Cliente Desde --}}
                        <div class="form-group">
                            <label for="cliente_desde">Cliente Desde</label>
                            <input type="date" class="form-control @error('cliente_desde') is-invalid @enderror"
                                id="cliente_desde" name="cliente_desde"
                                value="{{ old('cliente_desde', $empresa->cliente_desde ?? '') }}">
                            @error('cliente_desde')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success">
                            {{ isset($empresa) ? 'Atualizar' : 'Cadastrar' }}
                        </button>
                        <a href="{{ route('empresas.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal de Novo Endereço --}}
    <div class="modal fade" id="modalEndereco" tabindex="-1" role="dialog" aria-labelledby="modalEnderecoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formEndereco" action="{{ route('enderecos.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEnderecoLabel">Cadastrar Novo Endereço</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- Logradouro --}}
                        <div class="form-group">
                            <label for="logradouro">Logradouro</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro"
                                placeholder="Informe o logradouro" required>
                        </div>
                        {{-- Número --}}
                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero"
                                placeholder="Informe o número" required>
                        </div>
                        {{-- Bairro --}}
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro"
                                placeholder="Informe o bairro" required>
                        </div>
                        {{-- Cidade --}}
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade"
                                placeholder="Informe a cidade" required>
                        </div>
                        {{-- Estado --}}
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" class="form-control" id="estado" name="estado"
                                placeholder="Informe o estado" required>
                        </div>
                        {{-- CEP --}}
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep"
                                placeholder="Informe o CEP" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#formEndereco').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#endereco_id').append(new Option(
                            `${response.endereco.logradouro}, ${response.endereco.numero} - ${response.endereco.bairro}`,
                            response.endereco.id,
                            true,
                            true
                        ));
                        $('#modalEndereco').modal('hide');
                        $('#formEndereco')[0].reset();
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseJSON.message || 'Erro ao salvar o endereço.');
                }
            });
        });
    </script>
@stop
