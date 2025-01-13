@extends('adminlte::page')

@section('title', isset($cliente) ? 'Editar Cliente' : 'Novo Cliente')

@section('content_header')
    {{-- <h4>{{ isset($cliente) ? 'Editar Cliente' : 'Cadastrar Novo Cliente' }}</h4> --}}
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">{{ isset($cliente) ? 'Editar informações do Cliente' : 'Preencha os dados do novo Cliente' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($cliente) ? route('clientes.update', $cliente->id) : route('clientes.store') }}" method="POST">
                @csrf
                @if(isset($cliente))
                    @method('PUT')
                @endif
                <!-- CNPJ -->
                <div class="form-group col-md-12">
                    <label for="cnpj">CNPJ</label>
                    <div class="input-group">
                        <input type="text" id="cnpj" name="cnpj" class="form-control" placeholder="Digite o CNPJ"
                            value="{{ $cliente->cnpj ?? '' }}">
                        <button type="button" class="btn btn-info" id="search-cnpj">
                            <i class="fas fa-search"></i> Consultar CNPJ
                        </button>
                    </div>
                </div>

                <!-- Razão Social -->
                <x-adminlte-input id="razaoSocial" name="razaoSocial" label="Razão Social" placeholder="Digite a razão social" 
                    fgroup-class="col-md-12" value="{{ $cliente->razaoSocial ?? '' }}" required />

                <!-- Nome Fantasia -->
                <x-adminlte-input id="nomeFantasia" name="nomeFantasia" label="Nome Fantasia" placeholder="Digite o nome fantasia"
                    fgroup-class="col-md-12" value="{{ $cliente->nomeFantasia ?? '' }}" />


                <!-- Inscrição Estadual -->
                <x-adminlte-input id="ie" name="ie" label="Inscrição Estadual" placeholder="Digite a inscrição estadual"
                    fgroup-class="col-md-12" value="{{ $cliente->ie ?? '' }}" />

                <!-- E-mail -->
                <x-adminlte-input id="email" type="email" name="email" label="E-mail" placeholder="Digite o e-mail"
                    fgroup-class="col-md-12" value="{{ $cliente->email ?? '' }}" />

                <!-- Telefone -->
                <x-adminlte-input id="telefone" name="telefone" label="Telefone" placeholder="Digite o telefone"
                    fgroup-class="col-md-12" value="{{ $cliente->telefone ?? '' }}" />

                <!-- Endereço -->
                <div class="form-group col-md-12">
                    <label for="endereco_id">Endereço</label>
                    <div class="input-group">
                        <select class="form-control" id="endereco_id" name="endereco_id" required>
                            <option value="" disabled {{ !isset($cliente->endereco_id) ? 'selected' : '' }}>Selecione um endereço...</option>
                            @foreach($enderecos as $endereco)
                                <option value="{{ $endereco->id }}" 
                                    {{ isset($cliente->endereco_id) && $cliente->endereco_id == $endereco->id ? 'selected' : '' }}>
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
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save"></i> {{ isset($cliente) ? 'Atualizar' : 'Salvar' }}
                    </button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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
                            $('#razaoSocial').val(response.company.name || '');
                            $('#nomeFantasia').val(response.alias || '');
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
        $(document).ready(function () {
            $('#telefone').mask('(00) 00000-0000');
    
            $('#formEndereco').on('submit', function (e) {
                e.preventDefault(); 
    
                const form = $(this);
    
                $.ajax({
                    url: form.attr('action'), 
                    method: 'POST',          
                    data: form.serialize(),  
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            $('#endereco_id').append(
                                new Option(
                                    `${response.endereco.logradouro}, ${response.endereco.numero} - ${response.endereco.bairro}`,
                                    response.endereco.id,
                                    true,  
                                    true
                                )
                            );
    
                            alert(response.message || 'Endereço salvo com sucesso!');
    
                            $('#enderecoModal').modal('hide');
                            $('.modal-backdrop').remove();
                            form[0].reset();
                        } else {
                            alert(response.message || 'Erro ao salvar o endereço.');
                        }
                    },
                    error: function (xhr) {
                        const errors = xhr.responseJSON?.errors;
                        let message = xhr.responseJSON?.message || 'Erro ao salvar o endereço.';
    
                        if (errors) {
                            message += '\n' + Object.values(errors).map((err) => `- ${err}`).join('\n');
                        }
    
                        alert(message);
                        console.error(message);
                    }
                });
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
@endsection
