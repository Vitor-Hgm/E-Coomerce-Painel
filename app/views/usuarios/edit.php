<div class="container mt-4">
    <h3>Editar Usuário</h3>
    <?php if(!$usuario): ?>
        <div class="alert alert-warning">Usuário não encontrado.</div>
    <?php else: ?>
    <form method="POST" action="/E-Coomerce-Painel/public/?param=usuario/update">
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
        <div class="mb-3"><label class="form-label">Nome</label><input name="name" class="form-control" value="<?= htmlspecialchars($usuario['name']) ?>" required></div>
        <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required></div>
        <div class="mb-3"><label class="form-label">Senha (deixe em branco para manter)</label><input name="password" type="password" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Telefone</label><input name="phone" class="form-control" value="<?= htmlspecialchars($usuario['phone']) ?>"></div>
        <div class="form-check mb-3"><input name="active" type="checkbox" class="form-check-input" id="active" <?= $usuario['active'] ? 'checked' : '' ?>><label class="form-check-label" for="active">Ativo</label></div>

        <button class="btn btn-primary">Atualizar</button>
        <a class="btn btn-secondary" href="/E-Coomerce-Painel/public/?param=usuario/index">Cancelar</a>
    </form>
    <?php endif; ?>
</div>
