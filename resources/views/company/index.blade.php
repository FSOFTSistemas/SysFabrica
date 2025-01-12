@extends('adminlte::page')

@section('title', 'Editar Empresa')

@section('content_header')
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dados da Empresa</h3>
        </div>
        <form action="{{ route('updateCompany', $empresa[0]) }}" method="POST" id="formEndereco">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <input type="text" id="id" name="id" value="{{ $empresa[0]->id }}" hidden>
                    <!-- CNPJ -->
                    <div class="form-group col-md-6">
                        <label for="cnpj">CNPJ</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ old('cnpj', $empresa[0]->cnpj) }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info" id="search-cnpj">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Inscrição Estadual -->
                    <div class="form-group col-md-6">
                        <label for="ie">Inscrição Estadual</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="ie" name="ie" value="{{ old('ie', $empresa[0]->ie) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-id-card"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Razão Social -->
                    <div class="form-group col-md-6">
                        <label for="razao_social">Razão Social</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="razao_social" name="razao_social" value="{{ old('razao_social', $empresa[0]->razao_social) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-building"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Nome Fantasia -->
                    <div class="form-group col-md-6">
                        <label for="nome_fantasia">Nome Fantasia</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" value="{{ old('nome_fantasia', $empresa[0]->nome_fantasia) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-user-tag"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Status -->
                    <div class="form-group col-md-4">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="ativo" {{ old('status', $empresa[0]->status) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="inativo" {{ old('status', $empresa[0]->status) == 'inativo' ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>

                    <!-- Data de Vencimento -->
                    <div class="form-group col-md-4">
                        <label for="data_vencimento">Data de Vencimento</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="data_vencimento" name="data_vencimento" value="{{ old('data_vencimento', $empresa[0]->data_vencimento) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Cliente Desde -->
                    <div class="form-group col-md-4">
                        <label for="cliente_desde">Cliente Desde</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="cliente_desde" name="cliente_desde" value="{{ old('cliente_desde', $empresa[0]->cliente_desde) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Logradouro -->
                    <div class="form-group col-md-6">
                        <label for="logradouro">Logradouro</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ old('logradouro', $empresa[0]->logradouro) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-road"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Número -->
                    <div class="form-group col-md-2">
                        <label for="numero">Número</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero', $empresa[0]->numero) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-sort-numeric-up"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Bairro -->
                    <div class="form-group col-md-4">
                        <label for="bairro">Bairro</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro', $empresa[0]->bairro) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Cidade -->
                    <div class="form-group col-md-4">
                        <label for="cidade">Cidade</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade', $empresa[0]->cidade) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-city"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="form-group col-md-4">
                        <label for="estado">Estado</label>
                        <div class="input-group">
                            <select class="form-control" id="estado" name="estado">
                                <option value="" disabled selected>Selecione um estado</option>
                                @foreach(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'] as $uf)
                                    <option value="{{ $uf }}" {{ old('estado', $empresa[0]->estado ?? '') == $uf ? 'selected' : '' }}>
                                        {{ $uf }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-flag"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- CEP -->
                    <div class="form-group col-md-4">
                        <label for="cep">CEP</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep', $empresa[0]->cep) }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info" id="buscarCep">
                                    <i class="fas fa-search-location"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button id="save-button" type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-save"></i> Salvar
                </button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            // Máscaras
            $('#cnpj').mask('99.999.999/9999-99');
            $('#cep').mask('99999-999');

            // Busca CNPJ
            $('#search-cnpj').click(function() {
                const cnpj = $('#cnpj').val().replace(/\D/g, '');
                if (cnpj.length !== 14) {
                    alert('CNPJ inválido!');
                    return;
                }
                $.ajax({
                    url: `https://open.cnpja.com/office/${cnpj}`,
                    type: 'GET',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('Authorization',
                            'Bearer YOUR_API_TOKEN');
                    },
                    success: function(response) {
                        if (response) {
                            console.log(response);
                            $('#razao_social').val(response.company.name || '');
                            $('#nome_fantasia').val(response.alias || '');
                            $('#ie').val(response.registrations[0].number || '');
                            $('#logradouro').val(response.address.street);
                            $('#cidade').val(response.address.city);
                            $('#estado').val(response.address.state);
                            $('#bairro').val(response.address.district);
                            $('#cep').val(response.address.zip);
                            $('#numero').val(response.address.number);
                        } else {
                            alert('Nenhum dado encontrado para o CNPJ fornecido.');
                        }
                    },
                    error: function() {
                        alert('Ocorreu um erro ao buscar o CNPJ. Por favor, tente novamente.');
                    }
                });
            });

            // Busca CEP
            $('#buscarCep').click(function() {
                const cep = $('#cep').val().replace(/\D/g, '');
                if (cep.length !== 8) {
                    alert('CEP inválido!');
                    return;
                }
                fetch(`/endereco/${cep}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        console.log(data);
                        document.getElementById('logradouro').value = data.logradouro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                        document.getElementById('bairro').value = data.bairro;
                    } else {
                        alert('CEP não encontrado.');
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o endereço:', error);
                    alert('Erro ao buscar o endereço. Tente novamente.');
                });
            });
        });
    </script>
@endsection