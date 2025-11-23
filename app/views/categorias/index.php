<?php
// assumindo header/footer já embutidos; se usa includes, adapte
$usuario = $_SESSION['ecoomercepainel'] ?? null;
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Categorias</h3>
        <a href="/E-Coomerce-Painel/public/?param=categoria/create" class="btn btn-primary">+ Nova Categoria</a>
    </div>

    <?php if(!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
    <?php endif; ?>

    <table class="table table-striped bg-white">
        <thead class="table-dark">
            <tr><th>#</th><th>Nome</th><th>Ações</th></tr>
        </thead>
        <tbody>
            <?php if (!empty($categorias)): foreach($categorias as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['name']) ?></td>
                <td>
                    <a href="/E-Coomerce-Painel/public/?param=categoria/edit&id=<?= $c['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="/E-Coomerce-Painel/public/?param=categoria/delete&id=<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir categoria?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="3">Nenhuma categoria encontrada.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
