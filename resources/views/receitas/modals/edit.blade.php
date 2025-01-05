<!-- Modal Editar Receita -->
<div class="modal fade" id="editReceitaModal{{ $receita->id }}" tabindex="-1" aria-labelledby="editReceitaModalLabel{{ $receita->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReceitaModalLabel{{ $receita->id }}">Editar Receita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('receitas.update', $receita->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" name="descricao" class="form-control" value="{{ $receita->descricao }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="qtd" class="form-label">Quantidade</label>
                        <input type="number" name="qtd" class="form-control" value="{{ $receita->qtd }}" required step="0.01">
                    </div>
                    <input type="text" id="produto_id" name="produto_id" value="{{ $produto->id }}" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-warning">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>