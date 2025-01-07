<!-- Modal Visualizar -->
<div class="modal fade" id="viewFuncionarioModal{{ $funcionario->id }}" tabindex="-1" aria-labelledby="viewFuncionarioModalLabel{{ $funcionario->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewFuncionarioModalLabel{{ $funcionario->id }}">
                    <i class="fas fa-user"></i> Detalhes do Funcionário
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Corpo do Modal -->
            <div class="modal-body">
                <div class="row">
                    <!-- Coluna 1 -->
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-id-card"></i> Nome:</strong> {{ $funcionario->nome }}</p>
                        <p><strong><i class="fas fa-phone"></i> Telefone:</strong> {{ $funcionario->telefone }}</p>
                        <p><strong><i class="fas fa-calendar"></i> Data de Admissão:</strong> {{ \Carbon\Carbon::parse($funcionario->admissao)->format('d/m/Y') }}</p>
                    </div>
                    <!-- Coluna 2 -->
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-percent"></i> Comissão:</strong> R$ {{ number_format($funcionario->comissao, 2, ',', '.') }}</p>
                        <p><strong><i class="fas fa-users"></i> Situação:</strong> {{ $funcionario->situacao == 1 ? 'Ativo' : 'Inativo' }}</p>
                        <p><strong><i class="fas fa-map-marker-alt"></i> Endereço:</strong> {{ $funcionario->endereco->logradouro }}</p>
                    </div>
                </div>
            </div>

            <!-- Rodapé do Modal -->
            <div class="modal-footer d-flex justify-content-between">
                <span class="text-muted">
                    <small><i class="fas fa-clock"></i> Criado em: {{ $funcionario->created_at->format('d/m/Y H:i') }}</small>
                </span>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>