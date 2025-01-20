@foreach ($despesasFixas as $despesa)
<div class="modal fade" id="deleteDespesaModal{{ $despesa->id }}" tabindex="-1" aria-labelledby="deleteDespesaModalLabel{{ $despesa->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('despesas.destroy', $despesa->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDespesaModalLabel{{ $despesa->id }}">Excluir Despesa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza de que deseja excluir a despesa "<strong>{{ $despesa->descricao }}</strong>"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach