@foreach ($despesasFixas as $despesa)
    <div class="modal fade" id="editDespesaModal{{ $despesa->id }}" tabindex="-1"
        aria-labelledby="editDespesaModalLabel{{ $despesa->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('despesas.update', $despesa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDespesaModalLabel{{ $despesa->id }}">Editar Despesa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="descricao{{ $despesa->id }}" class="form-label">Descrição</label>
                            <input type="text" name="descricao" id="descricao{{ $despesa->id }}"
                                class="form-control" value="{{ $despesa->descricao }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="text" name="valor" id="valor" class="form-control" required
                                pattern="^\d*\.?\d*$" oninput="this.value = this.value.replace(/,/g, '.');">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
