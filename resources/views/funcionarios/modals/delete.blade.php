<!-- Modal Excluir -->
<div class="modal fade" id="deleteFuncionarioModal{{ $funcionario->id }}" tabindex="-1" aria-labelledby="deleteFuncionarioModalLabel{{ $funcionario->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteFuncionarioModalLabel{{ $funcionario->id }}">
                    <i class="fas fa-trash"></i> Excluir Funcionário
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <p>Você tem certeza de que deseja excluir o funcionário <strong>{{ $funcionario->nome }}</strong>?</p>
            </div>

            <!-- Rodapé do Modal -->
            <div class="modal-footer">
                <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>