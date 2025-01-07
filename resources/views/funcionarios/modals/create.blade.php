@extends('adminlte::page')

@section('title', isset($funcionario) ? 'Editar Funcionário' : 'Novo Funcionário')

@section('content_header')
    <h3 class="card-title">{{ isset($funcionario) ? 'Editar Funcionário' : 'Cadastrar Novo Funcionário' }}</h3>
@stop

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">{{ isset($funcionario) ? 'Editar informações do Funcionário' : 'Preencha os dados do novo Funcionário' }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ isset($funcionario) ? route('funcionarios.update', $funcionario->id) : route('funcionarios.store') }}" method="POST">
            @csrf
            @if(isset($funcionario)) @method('PUT') @endif

            <!-- Nome -->
            <x-adminlte-input id="nome" name="nome" label="Nome" placeholder="Digite o nome" 
                value="{{ $funcionario->nome ?? '' }}" fgroup-class="col-md-12" required />

            <!-- Telefone -->
            <x-adminlte-input id="telefone" name="telefone" label="Telefone" placeholder="Digite o telefone"
                value="{{ $funcionario->telefone ?? '' }}" fgroup-class="col-md-12" required />

            <!-- Data de Admissão -->
            <x-adminlte-input type="date" id="admissao" name="admissao" label="Data de Admissão" 
                value="{{ $funcionario->admissao ?? '' }}" fgroup-class="col-md-12" required />

            <!-- Comissão -->
            <x-adminlte-input id="comissao" name="comissao" label="Comissão" placeholder="Digite a comissão"
                value="{{ $funcionario->comissao ?? '' }}" type="number" step="0.01" fgroup-class="col-md-12" required />

            <!-- Situação -->
            <x-adminlte-select id="situacao" name="situacao" label="Situação" fgroup-class="col-md-12" required>
                <option value="1" {{ isset($funcionario) && $funcionario->situacao == 1 ? 'selected' : '' }}>Ativo</option>
                <option value="0" {{ isset($funcionario) && $funcionario->situacao == 0 ? 'selected' : '' }}>Inativo</option>
            </x-adminlte-select>

            <!-- Endereço -->
            <div class="form-group col-md-12">
                <label for="endereco_id">Endereço</label>
                <div class="input-group">
                    <select class="form-control" id="endereco_id" name="endereco_id" required>
                        <option value="" disabled {{ !isset($funcionario->endereco_id) ? 'selected' : '' }}>Selecione um endereço...</option>
                        @foreach($enderecos as $endereco)
                            <option value="{{ $endereco->id }}" 
                                {{ isset($funcionario->endereco_id) && $funcionario->endereco_id == $endereco->id ? 'selected' : '' }}>
                                {{ $endereco->logradouro }}, {{ $endereco->numero }} - {{ $endereco->cidade }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#enderecoModal">
                        <i class="fas fa-plus"></i> Novo Endereço
                    </button>
                </div>
            </div>

            <!-- Botão de Salvar -->
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($funcionario) ? 'Atualizar' : 'Salvar' }}
                </button>
                <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Modal para Novo Endereço -->
<div class="modal fade" id="enderecoModal" tabindex="-1" aria-labelledby="enderecoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('enderecos.store') }}" id="formEndereco">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar Novo Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <div class="input-group">
                            <input type="text" name="cep" id="cep" class="form-control" placeholder="Digite o CEP" required />
                            <button type="button" class="btn btn-info" id="buscarCep">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                    <x-adminlte-input id="logradouro" name="logradouro" label="Logradouro" placeholder="Digite o logradouro" required />
                    <x-adminlte-input id="numero" name="numero" label="Número" placeholder="Digite o número" required />
                    <x-adminlte-input id="bairro" name="bairro" label="Bairro" placeholder="Digite o bairro" required />
                    <x-adminlte-input id="cidade" name="cidade" label="Cidade" placeholder="Digite a cidade" required />
                    <x-adminlte-input id="estado" name="estado" label="Estado" placeholder="Digite o estado" required />
                    <x-adminlte-input id="ibge" name="ibge" label="ibge" placeholder="Digite o ebge" required />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar Endereço</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#telefone').mask('(00) 00000-0000');
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
                        $('#logradouro').val(data.logradouro);
                        $('#cidade').val(data.localidade);
                        $('#estado').val(data.uf);
                        $('#bairro').val(data.bairro);
                        $('#ibge').val(data.ibge);
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