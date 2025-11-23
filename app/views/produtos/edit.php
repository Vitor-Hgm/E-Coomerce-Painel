<?php $usuario = $_SESSION['ecoomercepainel'] ?? null; ?>
<div class="container mt-4">
    <h3>Editar Produto</h3>
    <?php if(!$produto): ?>
        <div class="alert alert-warning">Produto não encontrado.</div>
    <?php else: ?>
    <form method="POST" action="/E-Coomerce-Painel/public/?param=produto/update">
        <input type="hidden" name="id" value="<?= $produto['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($produto['nome']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"><?= htmlspecialchars($produto['descricao']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Preço</label>
            <input type="text" name="preco" class="form-control" value="<?= number_format($produto['preco'],2,'.','') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria_id" class="form-select">
                <option value="">— Selecionar —</option>
                <?php foreach($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $produto['categoria_id']==$c['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn btn-primary">Atualizar</button>
        <a class="btn btn-secondary" href="/E-Coomerce-Painel/public/?param=produto/index">Cancelar</a>
    </form>
    <?php endif; ?>
</div>
