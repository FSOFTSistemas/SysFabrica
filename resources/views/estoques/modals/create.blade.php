<div class="modal fade" id="createEstoqueModal" tabindex="-1" aria-labelledby="createEstoqueModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createEstoqueModalLabel">
                    <i class="fas fa-plus"></i> Adicionar Estoque
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <form action="{{ route('estoques.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="produto" class="form-label">Produto</label>
                        <select name="produto_id" id="produto" class="form-select select2" required>
                            <option value="" disabled selected>Selecione um produto</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="entradas" class="form-label">Entradas</label>
                        <input type="number" class="form-control" name="entradas" id="entradas" step="0.01" 
                               placeholder="Digite o número de entradas" oninput="calcularEstoque()">
                    </div>

                    <div class="mb-3">
                        <label for="saidas" class="form-label">Saídas</label>
                        <input type="number" class="form-control" name="saidas" id="saidas" step="0.01" 
                               placeholder="Digite o número de saídas" oninput="calcularEstoque()">
                    </div>

                    <!-- Estoque Atual será calculado -->
                    <div class="mb-3">
                        <label for="estoqueAtual" class="form-label">Estoque Atual</label>
                        <input type="number" class="form-control" name="estoque_atual" id="estoqueAtual" step="0.01" 
                               readonly>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Salvar Estoque</button>
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
    function calcularEstoque() {
        // Pegando os valores das entradas e saídas
        const entradas = parseFloat(document.getElementById('entradas').value) || 0;
        const saidas = parseFloat(document.getElementById('saidas').value) || 0;

        // Calculando o estoque atual
        const estoqueAtual = entradas - saidas;

        // Atualizando o campo 'estoque_atual'
        document.getElementById('estoqueAtual').value = estoqueAtual.toFixed(2);
    }
</script>