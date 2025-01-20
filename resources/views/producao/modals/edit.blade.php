<div class="modal fade" id="editOrdemModal{{ $ordem->id }}" tabindex="-1" aria-labelledby="editOrdemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('producao.update', $ordem->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrdemModalLabel">Editar Ordem de Produção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Funcionário -->
                    <div class="mb-3">
                        <label for="funcionario_id" class="form-label">Funcionário</label>
                        <select name="funcionario_id" id="funcionario_id" class="form-control select2" required>
                            <option value="">Selecione</option>
                            @foreach ($funcionarios as $funcionario)
                                <option value="{{ $funcionario->id }}" 
                                    {{ $ordem->funcionario_id == $funcionario->id ? 'selected' : '' }}>
                                    {{ $funcionario->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Produto -->
                    <div class="mb-3">
                        <label for="produto_id" class="form-label">Produto</label>
                        <select name="produto_id" id="produto_id" class="form-control select2" required>
                            <option value="">Selecione</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}" 
                                    {{ $ordem->produto_id == $produto->id ? 'selected' : '' }}>
                                    {{ $produto->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Produção Estimada -->
                    <div class="mb-3">
                        <label for="producao_estimada" class="form-label">Produção Estimada</label>
                        <input type="number" step="0.01" name="producao_estimada" id="producao_estimada" 
                            class="form-control" value="{{ $ordem->producao_estimada }}" required>
                    </div>

                    <!-- Produção Real -->
                    <div class="mb-3">
                        <label for="producao_real" class="form-label">Produção Real</label>
                        <input type="number" step="0.01" name="producao_real" id="producao_real" 
                            class="form-control" value="{{ $ordem->producao_real }}" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="sattus" class="form-label">Status</label>
                        <select name="sattus" id="sattus" class="form-control" required>
                            <option value="pendente" {{ $ordem->sattus == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="em_producao" {{ $ordem->sattus == 'em_producao' ? 'selected' : '' }}>Em Produção</option>
                            <option value="finalizado" {{ $ordem->sattus == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>