<div class="modal fade" id="editUserModal{{ $usuario->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $usuario->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editUserModalLabel{{ $usuario->id }}">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name{{ $usuario->id }}" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name{{ $usuario->id }}" name="name" value="{{ $usuario->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email{{ $usuario->id }}" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email{{ $usuario->id }}" name="email" value="{{ $usuario->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password{{ $usuario->id }}" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="password{{ $usuario->id }}" name="password">
                        <small class="form-text text-muted">Deixe em branco para manter a senha atual.</small>
                    </div>
                    <div class="mb-3">
                        <label for="permissions{{ $usuario->id }}" class="form-label">Permissões</label>
                        <select name="permissions[]" id="permissions{{ $usuario->id }}" class="form-control" multiple>
                            
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>