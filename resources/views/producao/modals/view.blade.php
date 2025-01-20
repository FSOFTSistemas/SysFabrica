<div class="modal fade" id="viewOrdemModal{{ $ordem->id }}" tabindex="-1" aria-labelledby="viewOrdemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOrdemModalLabel">Detalhes da Ordem de Produção</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Detalhes -->
                <p><strong>ID:</strong> {{ $ordem->id }}</p>
                <p><strong>Funcionário:</strong> {{ $ordem->funcionario->nome }}</p>
                <p><strong>Produto:</strong> {{ $ordem->produto->descricao }}</p>
                <p><strong>Produção Estimada:</strong> {{ number_format($ordem->producao_estimada, 2, ',', '.') }}</p>
                <p><strong>Produção Real:</strong> {{ number_format($ordem->producao_real ?? 0, 2, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($ordem->sattus) }}</p>
                <p><strong>Data de Criação:</strong> {{ $ordem->created_at->format('d/m/Y H:i:s') }}</p>
                <p><strong>Última Atualização:</strong> {{ $ordem->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>