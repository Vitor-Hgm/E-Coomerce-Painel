<?php $usuario = $_SESSION['ecoomercepainel'] ?? null; ?>
<div class="container mt-4">
    <h3>Novo Produto</h3>
    <form method="POST" action="/E-Coomerce-Painel/public/?param=produto/store">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Preço</label>
            <input type="text" name="preco" class="form-control" required placeholder="0.00">
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria_id" class="form-select">
                <option value="">— Selecionar —</option>
                <?php foreach($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn btn-success">Salvar</button>
        <a class="btn btn-secondary" href="/E-Coomerce-Painel/public/?param=produto/index">Cancelar</a>
    </form>
</div>
