<?php $usuario = $_SESSION['ecoomercepainel'] ?? null; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Produtos</h3>
        <a href="/E-Coomerce-Painel/public/?param=produto/create" class="btn btn-primary">+ Novo Produto</a>
    </div>

    <table class="table table-striped bg-white">
        <thead class="table-dark">
            <tr><th>#</th><th>Nome</th><th>Categoria</th><th>Preço</th><th>Ações</th></tr>
        </thead>
        <tbody>
            <?php if(!empty($produtos)): foreach($produtos as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td><?= htmlspecialchars($p['categoria_nome'] ?? '-') ?></td>
                <td>R$ <?= number_format($p['price'], 2, ',', '.') ?></td>
                <td>
                    <a href="/E-Coomerce-Painel/public/?param=produto/edit&id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="/E-Coomerce-Painel/public/?param=produto/delete&id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir produto?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="5">Nenhum produto encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
