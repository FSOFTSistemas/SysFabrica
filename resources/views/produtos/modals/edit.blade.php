<div class="modal fade" id="editProdutoModal{{ $produto->id }}" tabindex="-1"
    aria-labelledby="editProdutoModalLabel{{ $produto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editProdutoModalLabel{{ $produto->id }}">
                    <i class="fas fa-edit"></i> Editar Produto
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Corpo do Modal -->
            <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <!-- Coluna 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descricao{{ $produto->id }}" class="form-label"><i class="fas fa-tag"></i> Descrição:</label>
                                <input type="text" class="form-control" name="descricao" id="descricao{{ $produto->id }}" value="{{ $produto->descricao }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="precocusto{{ $produto->id }}" class="form-label"><i class="fas fa-dollar-sign"></i> Preço Custo:</label>
                                <input type="number" class="form-control" name="precocusto" id="precocusto{{ $produto->id }}" step="0.01" value="{{ $produto->precocusto }}" required>
                            </div>
                        </div>
                        <!-- Coluna 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="precoVenda{{ $produto->id }}" class="form-label"><i class="fas fa-dollar-sign"></i> Preço Venda:</label>
                                <input type="number" class="form-control" name="precoVenda" id="precoVenda{{ $produto->id }}" step="0.01" value="{{ $produto->precoVenda }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="comissao{{ $produto->id }}" class="form-label"><i class="fas fa-hand-holding-usd"></i> Comissão:</label>
                                <input type="number" class="form-control" name="comissao" id="comissao{{ $produto->id }}" step="0.01" value="{{ $produto->comissao }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="insumo{{ $produto->id }}" class="form-label"><i class="fas fa-toolbox"></i> Insumo:</label>
                        <select name="insumo" id="insumo{{ $produto->id }}" class="form-control">
                            <option value="sim" {{ $produto->insumo == 'sim' ? 'selected' : '' }}>Sim</option>
                            <option value="nao" {{ $produto->insumo == 'nao' ? 'selected' : '' }}>Não</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status{{ $produto->id }}" class="form-label"><i class="fas fa-toggle-on"></i> Status:</label>
                        <select name="status" id="status{{ $produto->id }}" class="form-control">
                            <option value="ativo" {{ $produto->status == 1 ? 'selected' : '' }}>Ativo</option>
                            <option value="inativo" {{ $produto->status == 0 ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                </div>

                <!-- Rodapé do Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>