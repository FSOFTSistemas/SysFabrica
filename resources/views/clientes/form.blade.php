@extends('adminlte::page')

@section('title', isset($cliente) ? 'Editar Cliente' : 'Criar Cliente')

@section('content_header')
    <h1>{{ isset($cliente) ? 'Editar Cliente' : 'Criar Cliente' }}</h1>
@stop

@section('content')

    <div class="container">

        <!-- Formulário de Cliente -->
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="razaoSocial">Razão Social</label>
                <input type="text" class="form-control @error('razaoSocial') is-invalid @enderror" id="razaoSocial"
                    name="razaoSocial" value="{{ old('razaoSocial') }}" required>
                @error('razaoSocial')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nomeFantasia">Nome Fantasia</label>
                <input type="text" class="form-control @error('nomeFantasia') is-invalid @enderror" id="nomeFantasia"
                    name="nomeFantasia" value="{{ old('nomeFantasia') }}" required>
                @error('nomeFantasia')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cnpj">CNPJ</label>
                <input type="text" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj" name="cnpj"
                    value="{{ old('cnpj') }}" required>
                @error('cnpj')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf"
                    value="{{ old('cpf') }}" required>
                @error('cpf')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="ie">Inscrição Estadual (IE)</label>
                <input type="text" class="form-control @error('ie') is-invalid @enderror" id="ie" name="ie"
                    value="{{ old('ie') }}" required>
                @error('ie')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control @error('telefone') is-invalid @enderror" id="telefone"
                    name="telefone" value="{{ old('telefone') }}" required>
                @error('telefone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campo de Endereço com Modal -->
            <div class="form-group">
                <label for="endereco_id">Endereço</label>
                <div class="input-group">
                    <select class="form-control @error('endereco_id') is-invalid @enderror" id="endereco_id"
                        name="endereco_id" required>
                        <option value="">Selecione um endereço</option>
                        @foreach ($enderecos as $endereco)
                            <option value="{{ $endereco->id }}"
                                {{ old('endereco_id') == $endereco->id ? 'selected' : '' }}>
                                {{ $endereco->logradouro }}, {{ $endereco->numero }} - {{ $endereco->bairro }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#modalEndereco">
                        Adicionar Novo
                    </button>
                </div>
                @error('endereco_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>

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
                        {{-- CEP --}}
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="cep" name="cep"
                                    placeholder="Informe o CEP" required>
                                <button type="button" class="btn btn-outline-secondary" id="buscarCep">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>

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
                        {{-- ibge --}}
                        <div class="form-group">
                            <label for="ibge">Código ibge</label>
                            <input type="text" class="form-control" id="ibge" name="ibge"
                                placeholder="Informe o codigo do ibge" required>
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

@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> --}}
    <script>
        $('#telefone').mask('(00) 00000-0000');
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
                        document.getElementById('ibge').value = data.ibge;
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
