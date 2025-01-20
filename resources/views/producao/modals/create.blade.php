<div class="modal fade" id="createOrdemModal" tabindex="-1" aria-labelledby="createOrdemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('producao.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createOrdemModalLabel">Criar Nova Ordem de Produção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Funcionário -->
                    <div class="mb-3">
                        <label for="funcionario_id" class="form-label">Funcionário</label>
                        <select name="funcionario_id" id="funcionario_id" class="form-control select2" required>
                            <option value="">Selecione</option>
                            @foreach ($funcionarios as $funcionario)
                                <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Produto -->
                    <div class="mb-3">
                        <label for="produto_id" class="form-label">Produto</label>
                        <select name="produto_id" id="produto_id" class="form-control select2" required>
                            <option value="">Selecione</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->descricao }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Produção Estimada -->
                    <div class="mb-3">
                        <label for="producao_estimada" class="form-label">Produção Estimada</label>
                        <input type="text" step="0.01" name="producao_estimada" id="producao_estimada" 
                            class="form-control" required placeholder="0.00" oninput="validateFloat(this)">
                    </div>

                     <!-- Produção real -->
                     <div class="mb-3">
                        <label for="producao_real" class="form-label">Produção Real</label>
                        <input type="text" step="0.01" name="producao_real" id="producao_real"
                            class="form-control" required placeholder="0.00" oninput="validateFloat(this)">
                    </div>


                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="conluido">Conluido</option>
                            <option value="executando">Executando</option>
                            <option value="esperando">Esperando</option>
                        </select>
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
<script>
    function validateFloat(input) {
        // Permite apenas números e um único ponto
        input.value = input.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    }
</script>