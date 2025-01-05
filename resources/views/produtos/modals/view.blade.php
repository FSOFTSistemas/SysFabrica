<div class="modal fade" id="viewProdutoModal{{ $produto->id }}" tabindex="-1"
    aria-labelledby="viewProdutoModalLabel{{ $produto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewProdutoModalLabel{{ $produto->id }}">
                    <i class="fas fa-box"></i> Detalhes do Produto
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <div class="row">
                    <!-- Coluna 1 -->
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-tag"></i> Descrição:</strong> {{ $produto->descricao }}</p>
                        <p><strong><i class="fas fa-dollar-sign"></i> Preço Custo:</strong>
                            R$ {{ number_format($produto->precocusto, 2, ',', '.') }}</p>
                        <p><strong><i class="fas fa-dollar-sign"></i> Preço Venda:</strong>
                            R$ {{ number_format($produto->precoVenda, 2, ',', '.') }}</p>
                    </div>
                    <!-- Coluna 2 -->
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-hand-holding-usd"></i> Comissão:</strong> {{ $produto->comissao }}%
                        </p>
                        <p><strong><i class="fas fa-toolbox"></i> Insumo:</strong>
                            {{ $produto->insumo == 'sim' ? 'Sim' : 'Não' }}</p>
                        <p><strong><i class="fas fa-toggle-on"></i> Status:</strong>
                            {{ $produto->status == 1 ? 'Ativo' : 'Inativo' }}</p>
                    </div>
                </div>
            </div>

            <!-- Rodapé do Modal -->
            <div class="modal-footer d-flex justify-content-between">
                <span class="text-muted">
                    <small><i class="fas fa-clock"></i> Criado em:
                        {{ $produto->created_at->format('d/m/Y H:i') }}</small>
                </span>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
