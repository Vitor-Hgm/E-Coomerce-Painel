<?php $usuario = $_SESSION['ecoomercepainel'] ?? null; ?>
<div class="container mt-4">
    <h3>Editar Categoria</h3>
    <?php if(!$categoria): ?>
        <div class="alert alert-warning">Categoria não encontrada.</div>
    <?php else: ?>
    <form method="POST" action="/E-Coomerce-Painel/public/?param=categoria/update">
        <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
        </div>
        <button class="btn btn-primary">Atualizar</button>
        <a class="btn btn-secondary" href="/E-Coomerce-Painel/public/?param=categoria/index">Cancelar</a>
    </form>
    <?php endif; ?>
</div>
