<?php $usuario = $_SESSION["ecoomercepainel"] ?? null; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produtos - Ecommerce Painel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
.dashboard-header { padding: 20px; background: #111827; color: #fff; display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-radius:8px; }
.dashboard-header h2 { font-size: 22px; font-weight:600; }
.table img { width: 50px; height: 50px; object-fit: cover; border-radius:4px; }
</style>
</head>
<body class="p-4">

<div class="dashboard-header">
    <h2>Lista de Produtos</h2>
    <a href="/E-Coomerce-Painel/public/produto/create" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Novo Produto
    </a>
</div>

<div class="table-responsive">
<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>Imagem</th>
            <th>ID</th>
            <th>Nome</th>
            <th>Slug</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ativo</th>
            <th>Destaque</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($produtos as $p): ?>
        <tr>
            <td>
                <?php if(!empty($p['image'])): ?>
                <img src="/E-Coomerce-Painel/public/uploads/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                <?php else: ?>
                <img src="/E-Coomerce-Painel/public/uploads/default.png" alt="Sem imagem">
                <?php endif; ?>
            </td>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['slug']) ?></td>
            <td><?= htmlspecialchars($p['category_name'] ?? '') ?></td>
            <td>R$ <?= number_format($p['price'], 2, ',', '.') ?></td>
            <td><?= $p['stock_quantity'] ?></td>
            <td><?= $p['active'] ? 'Sim' : 'Não' ?></td>
            <td><?= $p['featured'] ? 'Sim' : 'Não' ?></td>
            <td>
                <a href="/E-Coomerce-Painel/public/produto/edit/<?= $p['id'] ?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen"></i></a>
                <button class="btn btn-sm btn-danger btn-excluir" data-url="/E-Coomerce-Painel/public/produto/delete/<?= $p['id'] ?>"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Confirmação bonita de exclusão
document.querySelectorAll('.btn-excluir').forEach(function(btn){
    btn.addEventListener('click', function(){
        Swal.fire({
            title: 'Tem certeza?',
            text: "O produto será excluído permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = btn.dataset.url + '?deleted=1';
            }
        });
    });
});

// Mensagem de sucesso após exclusão
<?php if(isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
Swal.fire({
    title: 'Excluído!',
    text: 'Produto excluído com sucesso.',
    icon: 'success',
    confirmButtonText: 'OK'
});
<?php endif; ?>
</script>

</body>
</html>
