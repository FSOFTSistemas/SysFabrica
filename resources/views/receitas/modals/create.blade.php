<!-- Modal Criar Receita -->
<div class="modal fade" id="createReceitaModal" tabindex="-1" aria-labelledby="createReceitaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createReceitaModalLabel">Nova Receita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('receitas.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ingrediente_id">Selecione o ingrediente</label>
                        <select name="ingrediente_id" id="ingrediente_id" class="form-control" required>
                            <option value="#">Selecione o ingrediente</option>
                            @foreach($ingredientes as $ingrediente)
                                <option value="{{ $ingrediente->id }}">{{ $ingrediente->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="qtd">Quantidade(kg)</label>
                        <input type="number" id="qtd" name="qtd" class="form-control" required step="0.01" min="0">
                    </div>
                    <input type="text" name="produto_id" id="produto_id" value="{{ $produto->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Criar Receita</button>
                </div>
            </form>
        </div>
    </div>
</div>