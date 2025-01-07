<div class="modal fade" id="viewEstoqueModal{{ $estoque->id }}" tabindex="-1"
    aria-labelledby="viewEstoqueModalLabel{{ $estoque->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewEstoqueModalLabel{{ $estoque->id }}">
                    <i class="fas fa-box"></i> Detalhes do Estoque
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <div class="row">
                    <!-- Coluna 1 -->
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-tag"></i> Produto:</strong> {{ $estoque->produto->descricao }}</p>
                        <p><strong><i class="fas fa-boxes"></i> Estoque Atual:</strong>
                            {{ number_format($estoque->estoque_atual, 2, ',', '.') }}</p>
                        <p><strong><i class="fas fa-arrow-up"></i> Entradas:</strong>
                            {{ number_format($estoque->entradas, 2, ',', '.') }}</p>
                    </div>
                    <!-- Coluna 2 -->
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-arrow-down"></i> Saídas:</strong>
                            {{ number_format($estoque->saidas, 2, ',', '.') }}</p>
                        <p><strong><i class="fas fa-building"></i> Empresa:</strong> {{ $estoque->empresa->razao_social }}</p>
                    </div>
                </div>
            </div>

            <!-- Rodapé do Modal -->
            <div class="modal-footer d-flex justify-content-between">
                <span class="text-muted">
                    <small><i class="fas fa-clock"></i> Criado em:
                        {{ $estoque->created_at->format('d/m/Y H:i') }}</small>
                </span>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>