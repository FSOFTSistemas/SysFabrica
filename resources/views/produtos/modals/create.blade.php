<div class="modal fade" id="createProdutoModal" tabindex="-1" aria-labelledby="createProdutoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('produtos.store') }}" method="POST">
                @csrf
                <!-- Cabeçalho do Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createProdutoModalLabel">
                        <i class="fas fa-cogs"></i> Adicionar Novo Produto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Corpo do Modal -->
                <div class="modal-body">
                    <div class="row">
                        <!-- Coluna 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição:</label>
                                <input type="text" class="form-control" name="descricao" id="descricao" required>
                            </div>
                            <div class="mb-3">
                                <label for="precocusto" class="form-label">Preço Custo:</label>
                                <input type="number" class="form-control" name="precocusto" id="precocusto" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="precoVenda" class="form-label">Preço Venda:</label>
                                <input type="number" class="form-control" name="precoVenda" id="precoVenda" step="0.01" required>
                            </div>
                        </div>
                        <!-- Coluna 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="comissao" class="form-label">Comissão:</label>
                                <input type="number" class="form-control" name="comissao" id="comissao" step="0.01" value="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="insumo" class="form-label">Insumo:</label>
                                <select name="insumo" id="insumo" class="form-control">
                                    <option value="sim">Sim</option>
                                    <option value="nao">Não</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rodapé do Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>