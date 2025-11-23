    <div class="container mt-4">
    <h3>Novo Usuário</h3>
    <form method="POST" action="/E-Coomerce-Painel/public/?param=usuario/store">
        <div class="mb-3"><label class="form-label">Nome</label><input name="name" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Senha</label><input name="password" type="password" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Telefone</label><input name="phone" class="form-control"></div>
        <div class="form-check mb-3"><input name="active" type="checkbox" class="form-check-input" id="active"><label class="form-check-label" for="active">Ativo</label></div>
        <button class="btn btn-success">Salvar</button>
        <a class="btn btn-secondary" href="/E-Coomerce-Painel/public/?param=usuario/index">Cancelar</a>
    </form>
</div>
