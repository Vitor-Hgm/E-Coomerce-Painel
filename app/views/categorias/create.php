<?php $usuario = $_SESSION['ecoomercepainel'] ?? null; ?>
<div class="container mt-4">
    <h3>Nova Categoria</h3>
    <form method="POST" action="/E-Coomerce-Painel/public/?param=categoria/store">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <button class="btn btn-success">Salvar</button>
        <a class="btn btn-secondary" href="/E-Coomerce-Painel/public/?param=categoria/index">Cancelar</a>
    </form>
</div>
