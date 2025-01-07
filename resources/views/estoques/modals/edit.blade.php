<div class="modal fade" id="editEstoqueModal{{ $estoque->id }}" tabindex="-1" aria-labelledby="editEstoqueModalLabel{{ $estoque->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editEstoqueModalLabel{{ $estoque->id }}">
                    <i class="fas fa-edit"></i> Editar Estoque
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <form action="{{ route('estoques.update', $estoque->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="produto" class="form-label">Produto</label>
                        <select name="produto_id" id="produto" class="form-select select2" required>
                            <option value="{{ $estoque->produto_id }}" selected>{{ $estoque->produto->descricao }}</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="entradas" class="form-label">Entradas</label>
                        <input type="number" class="form-control" name="entradas" id="entradasEdit" step="0.01" 
                               placeholder="Digite o número de entradas" value="{{ $estoque->entradas }}" oninput="calcularEstoqueEdit()">
                    </div>

                    <div class="mb-3">
                        <label for="saidas" class="form-label">Saídas</label>
                        <input type="number" class="form-control" name="saidas" id="saidasEdit" step="0.01" 
                               placeholder="Digite o número de saídas" value="{{ $estoque->saidas }}" oninput="calcularEstoqueEdit()">
                    </div>

                    <!-- Estoque Atual será calculado -->
                    <div class="mb-3">
                        <label for="estoqueAtual" class="form-label">Estoque Atual</label>
                        <input type="number" class="form-control" name="estoque_atual" id="estoqueAtualEdit" step="0.01" 
                               value="{{ $estoque->estoque_atual }}" >
                    </div>

                    <button type="submit" class="btn btn-warning">Atualizar Estoque</button>
                </form>
            </div>

            <!-- Rodapé do Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    
    function calcularEstoqueEdit() {

        const entradas = parseFloat(document.getElementById('entradasEdit').value) || 0;
        const saidas = parseFloat(document.getElementById('saidasEdit').value) || 0;

        const estoqueAtual = entradas - saidas;

        document.getElementById('estoqueAtualEdit').value = estoqueAtual.toFixed(2);
    }
</script>