<?php $sessUser = $_SESSION['ecoomercepainel'] ?? null; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Usuários</h3>
        <a href="/E-Coomerce-Painel/public/?param=usuario/create" class="btn btn-primary">+ Novo Usuário</a>
    </div>

    <table class="table table-striped bg-white">
        <thead class="table-dark">
            <tr><th>#</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ativo</th><th>Ações</th></tr>
        </thead>
        <tbody>
            <?php if(!empty($usuarios)): foreach($usuarios as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= htmlspecialchars($u['phone']) ?></td>
                <td><?= $u['active'] ? 'Sim' : 'Não' ?></td>
                <td>
                    <a class="btn btn-sm btn-warning" href="/E-Coomerce-Painel/public/?param=usuario/edit&id=<?= $u['id'] ?>">Editar</a>
                    <a class="btn btn-sm btn-danger" href="/E-Coomerce-Painel/public/?param=usuario/delete&id=<?= $u['id'] ?>" onclick="return confirm('Excluir usuário?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="6">Nenhum usuário encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
