<!-- Modal Excluir Receita -->
<div class="modal fade" id="deleteReceitaModal{{ $receita->id }}" tabindex="-1" aria-labelledby="deleteReceitaModalLabel{{ $receita->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteReceitaModalLabel{{ $receita->id }}">Excluir Receita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('receitas.destroy', $receita->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir a receita <strong>{{ $receita->descricao }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>