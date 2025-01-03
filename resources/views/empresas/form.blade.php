@extends('adminlte::page')

@section('title', isset($empresa) ? 'Editar Empresa' : 'Nova Empresa')

@section('content')
<div class="container">
    <h1>{{ isset($empresa) ? 'Editar Empresa' : 'Criar Empresa' }}</h1>

    <form action="{{ isset($empresa) ? route('empresas.update', $empresa->id) : route('empresas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($empresa))
            @method('PUT')
        @endif

        <!-- CNPJ -->
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <div class="input-group">
                <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj" name="cnpj" 
                    value="{{ old('cnpj', $empresa->cnpj ?? '') }}" required>
                <button type="button" class="btn btn-outline-secondary" id="search-cnpj">
                    <i class="fas fa-search"></i>
                </button>
                @error('cnpj')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Inscrição Estadual (IE) -->
        <div class="form-group">
            <label for="ie">Inscrição Estadual</label>
            <input type="text" class="form-control @error('ie') is-invalid @enderror" id="ie" name="ie" 
                value="{{ old('ie', $empresa->ie ?? '') }}">
            @error('ie')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Razão Social -->
        <div class="form-group">
            <label for="razao_social">Razão Social</label>
            <input type="text" class="form-control @error('razao_social') is-invalid @enderror" id="razao_social" name="razao_social" 
                value="{{ old('razao_social', $empresa->razao_social ?? '') }}" required>
            @error('razao_social')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nome Fantasia -->
        <div class="form-group">
            <label for="nome_fantasia">Nome Fantasia</label>
            <input type="text" class="form-control @error('nome_fantasia') is-invalid @enderror" id="nome_fantasia" name="nome_fantasia" 
                value="{{ old('nome_fantasia', $empresa->nome_fantasia ?? '') }}">
            @error('nome_fantasia')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="">Selecione...</option>
                <option value="ativo" {{ old('status', $empresa->status ?? '') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ old('status', $empresa->status ?? '') == 'inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Data de Vencimento -->
        <div class="form-group">
            <label for="data_vencimento">Data de Vencimento</label>
            <input type="date" class="form-control @error('data_vencimento') is-invalid @enderror" id="data_vencimento" name="data_vencimento" 
                value="{{ old('data_vencimento', $empresa->data_vencimento ?? '') }}">
            @error('data_vencimento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cliente Desde -->
        <div class="form-group">
            <label for="cliente_desde">Cliente Desde</label>
            <input type="date" class="form-control @error('cliente_desde') is-invalid @enderror" id="cliente_desde" name="cliente_desde" 
                value="{{ old('cliente_desde', $empresa->cliente_desde ?? '') }}">
            @error('cliente_desde')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Upload do Logo -->
        <div class="form-group">
            <label for="path_logo">Logo</label>
            <input type="file" class="form-control @error('path_logo') is-invalid @enderror" id="path_logo" name="path_logo">
            @error('path_logo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Logradouro -->
        <div class="form-group">
            <label for="logradouro">Logradouro</label>
            <input type="text" class="form-control @error('logradouro') is-invalid @enderror" id="logradouro" name="logradouro" 
                value="{{ old('logradouro', $empresa->logradouro ?? '') }}" required>
            @error('logradouro')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Número -->
        <div class="form-group">
            <label for="numero">Número</label>
            <input type="text" class="form-control @error('numero') is-invalid @enderror" id="numero" name="numero" 
                value="{{ old('numero', $empresa->numero ?? '') }}" required>
            @error('numero')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bairro -->
        <div class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control @error('bairro') is-invalid @enderror" id="bairro" name="bairro" 
                value="{{ old('bairro', $empresa->bairro ?? '') }}" required>
            @error('bairro')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cidade -->
        <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control @error('cidade') is-invalid @enderror" id="cidade" name="cidade" 
                value="{{ old('cidade', $empresa->cidade ?? '') }}" required>
            @error('cidade')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Estado -->
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" 
                value="{{ old('estado', $empresa->estado ?? '') }}" required>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- CEP -->
        <div class="form-group">
            <label for="cep">CEP</label>
            <div class="input-group">
                <input type="text" class="form-control @error('cep') is-invalid @enderror" id="cep" name="cep" 
                    value="{{ old('cep', $empresa->cep ?? '') }}" required>
                <button type="button" class="btn btn-outline-secondary" id="btn-search-cep">
                    <i class="fas fa-search"></i>
                </button>
                @error('cep')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Botões -->
        <button type="submit" class="btn btn-primary">{{ isset($empresa) ? 'Atualizar' : 'Salvar' }}</button>
        <a href="{{ route('empresas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cnpj').mask('99.999.999/9999-99');

            $('#search-cnpj').on('click', function() {
                const cnpj = $('#cnpj').val().replace(/[^\d]/g, '');
                if (cnpj.length !== 14) {
                    alert('Por favor, insira um CNPJ válido com 14 dígitos.');
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
        });
    </script>
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
    <script>
        document.getElementById('buscarCep').addEventListener('click', function() {
            var cep = document.getElementById('cep').value;

            if (!cep) {
                alert('Por favor, insira um CEP.');
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
    </script>

@stop
