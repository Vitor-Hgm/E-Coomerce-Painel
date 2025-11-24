<?php 
$usuarioLogado = $_SESSION["ecoomercepainel"] ?? null; 
$success = $_SESSION['success'] ?? null;
unset($_SESSION['success']); // Limpa a mensagem após exibir
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Usuários - Ecommerce Painel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
.dashboard-header { padding: 20px; background: #111827; color: #fff; display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-radius:8px; }
.table img { width: 50px; height: 50px; object-fit: cover; border-radius:4px; }

/* BOTÃO BONITO DE VOLTAR */
.btn-voltar {
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 18px;
    font-size:16px;
    border-radius:10px;
    background: linear-gradient(135deg, #4b5563, #1f2937);
    color:white;
    border:none;
    box-shadow: 0 3px 8px rgba(0,0,0,0.25);
    text-decoration:none;
    transition:0.25s ease;
}
.btn-voltar:hover {
    background: linear-gradient(135deg, #6b7280, #374151);
    transform: translateY(-2px);
    color:white;
}
</style>
</head>
<body class="p-4">

<!-- BOTÃO BONITO DE VOLTAR PARA O DASHBOARD -->
<a href="/E-Coomerce-Painel/public/index" class="btn-voltar mb-3">
    <i class="fa-solid fa-arrow-left"></i> Voltar ao Dashboard
</a>

<div class="dashboard-header">
    <h2>Lista de Usuários</h2>
    <a href="/E-Coomerce-Painel/public/usuario/create" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Novo Usuário
    </a>
</div>

<div class="table-responsive">
<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Gênero</th>
            <th>Newsletter</th>
            <th>SMS Marketing</th>
            <th>Ativo</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($usuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['name']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['phone'] ?? '-') ?></td>
            <td><?= $u['gender'] ?? '-' ?></td>
            <td><?= ($u['newsletter'] ?? 0) ? 'Sim' : 'Não' ?></td>
            <td><?= ($u['sms_marketing'] ?? 0) ? 'Sim' : 'Não' ?></td>
            <td><?= ($u['active'] ?? 0) ? 'Sim' : 'Não' ?></td>
            <td><?= htmlspecialchars($u['role'] ?? 'user') ?></td>
            <td>
                <a href="/E-Coomerce-Painel/public/usuario/edit/<?= $u['id'] ?>" class="btn btn-sm btn-warning">
                    <i class="fa-solid fa-pen"></i>
                </a>
                <button class="btn btn-sm btn-danger btn-excluir" data-url="/E-Coomerce-Painel/public/usuario/delete/<?= $u['id'] ?>">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.btn-excluir').forEach(function(btn){
    btn.addEventListener('click', function(){
        Swal.fire({
            title: 'Deseja realmente excluir este usuário?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = btn.dataset.url;
            }
        });
    });
});

// Mostra mensagem de sucesso se existir
<?php if($success): ?>
Swal.fire({
    icon: 'success',
    title: 'Sucesso!',
    text: '<?= addslashes($success) ?>',
    timer: 2000,
    showConfirmButton: false
});
<?php endif; ?>
</script>

</body>
</html>
