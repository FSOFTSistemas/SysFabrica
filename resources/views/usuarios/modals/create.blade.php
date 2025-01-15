@extends('adminlte::page')

@section('title', 'Criar Novo Usuário')

@section('content_header')
    <h1 class="m-0 text-dark">Criar Novo Usuário</h1>
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Novo Usuário</h3>
        </div>
        <!-- /.card-header -->

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <!-- Nome -->
                <div class="form-group">
                    <label for="name">Nome</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Digite o nome do usuário" required>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Digite o email do usuário" required>
                    </div>
                </div>

                <!-- Senha -->
                <div class="form-group">
                    <label for="password">Senha</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Digite a senha" required>
                    </div>
                </div>

                <!-- Permissões -->
                <div class="form-group">
                    <label for="permissions">Permissões</label>
                    <select class="js-example-basic-multiple w-100" name="permission[]" multiple="multiple">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@stop
