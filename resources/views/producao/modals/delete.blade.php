<div class="modal fade" id="deleteOrdemModal{{ $ordem->id }}" tabindex="-1" aria-labelledby="deleteOrdemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('producao.destroy', $ordem->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteOrdemModalLabel">Excluir Ordem de Produção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza de que deseja excluir esta ordem de produção?</p>
                    <p><strong>Funcionário:</strong> {{ $ordem->funcionario->nome }}</p>
                    <p><strong>Produto:</strong> {{ $ordem->produto->descricao }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>