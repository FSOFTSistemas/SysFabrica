<!-- Modal Editar -->
<div class="modal fade" id="editFuncionarioModal{{ $funcionario->id }}" tabindex="-1" aria-labelledby="editFuncionarioModalLabel{{ $funcionario->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editFuncionarioModalLabel{{ $funcionario->id }}">
                    <i class="fas fa-pencil-alt"></i> Editar Funcionário
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Coluna 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ $funcionario->nome }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $funcionario->telefone }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="admissao" class="form-label">Data de Admissão</label>
                                <input type="date" class="form-control" id="admissao" name="admissao" value="{{ $funcionario->admissao }}" required>
                            </div>
                        </div>
                        <!-- Coluna 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="comissao" class="form-label">Comissão</label>
                                <input type="number" class="form-control" id="comissao" name="comissao" value="{{ $funcionario->comissao }}" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="situacao" class="form-label">Situação</label>
                                <select class="form-select" id="situacao" name="situacao" required>
                                    <option value="1" {{ $funcionario->situacao == 1 ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ $funcionario->situacao == 0 ? 'selected' : '' }}>Inativo</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="endereco_id" class="form-label">Endereço</label>
                                <select class="form-select" id="endereco_id" name="endereco_id" required>
                                    @foreach ($enderecos as $endereco)
                                        <option value="{{ $endereco->id }}" {{ $funcionario->endereco_id == $endereco->id ? 'selected' : '' }}>{{ $endereco->logradouro }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>