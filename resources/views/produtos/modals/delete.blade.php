<div class="modal fade" id="deleteProdutoModal{{ $produto->id }}" tabindex="-1"
    aria-labelledby="deleteProdutoModalLabel{{ $produto->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <!-- Cabeçalho do Modal -->
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteEstoqueModalLabel{{ $produto->id }}">
                        <i class="fas fa-trash"></i> Confirmar Exclusão
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir o produto <strong>{{ $produto->descricao }}</strong>?</p>
                </div>
                <!-- Rodapé do Modal -->
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-secondary btn-block w-100"
                                data-bs-dismiss="modal">Não</button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-danger btn-block w-100">Sim</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
