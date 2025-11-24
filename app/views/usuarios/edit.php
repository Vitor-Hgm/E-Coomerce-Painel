<?php $usuarioSessao = $_SESSION["ecoomercepainel"] ?? null; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Usuário - Ecommerce Painel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
.dashboard-header { padding: 20px; background: #111827; color: #fff; display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-radius:8px; }
.dashboard-header h2 { font-size: 22px; font-weight:600; }
.card-form { background: #fff; padding:30px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1); max-width:700px; margin:auto; }
.card-form h3 { margin-bottom:20px; font-weight:600; color:#111827; }
.form-label { font-weight:500; }
input.form-control, select.form-control { border-radius:8px; padding:12px; }
button.btn-primary { border-radius:8px; padding:10px 20px; font-weight:500; }
button.btn-primary i { margin-right:5px; }
.alert { border-radius:8px; }
</style>
</head>
<body class="p-4">

<div class="dashboard-header">
    <h2>Editar Usuário</h2>
    <a href="/E-Coomerce-Painel/public/usuario" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="card-form">
    <h3>Edite os detalhes do usuário</h3>

    <!-- Mensagens de sucesso/erro -->
    <?php if(!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if(!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="/E-Coomerce-Painel/public/usuario/update/<?= $usuario['id'] ?>" method="POST">

        <!-- Nome e Email -->
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($usuario['name'] ?? '') ?>" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" required>
            </div>
        </div>

        <!-- Senha -->
        <div class="mb-3">
            <label for="password" class="form-label">Senha <small class="text-muted">(preencha somente se quiser alterar)</small></label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <!-- Telefone e Data de Nascimento -->
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label for="phone" class="form-label">Telefone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($usuario['phone'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label for="birth_date" class="form-label">Data de Nascimento</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" value="<?= $usuario['birth_date'] ?? '' ?>">
            </div>
        </div>

        <!-- Gênero -->
        <div class="mb-3">
            <label class="form-label">Gênero</label>
            <select name="gender" class="form-control">
                <option value="">Selecione</option>
                <option value="M" <?= ($usuario['gender'] ?? '')=='M'?'selected':'' ?>>Masculino</option>
                <option value="F" <?= ($usuario['gender'] ?? '')=='F'?'selected':'' ?>>Feminino</option>
                <option value="O" <?= ($usuario['gender'] ?? '')=='O'?'selected':'' ?>>Outro</option>
            </select>
        </div>

        <!-- Checkboxes -->
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="newsletter" id="newsletter" <?= ($usuario['newsletter'] ?? 0) ? 'checked' : '' ?>>
            <label class="form-check-label" for="newsletter">Receber Newsletter</label>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="sms_marketing" id="sms_marketing" <?= ($usuario['sms_marketing'] ?? 0) ? 'checked' : '' ?>>
            <label class="form-check-label" for="sms_marketing">Receber SMS Marketing</label>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="active" id="active" <?= ($usuario['active'] ?? 0) ? 'checked' : '' ?>>
            <label class="form-check-label" for="active">Ativo</label>
        </div>

        <!-- Tipo de usuário -->
        <div class="mb-3">
            <label class="form-label">Tipo de usuário</label>
            <select name="role" class="form-control">
                <option value="user" <?= ($usuario['role'] ?? '')=='user'?'selected':'' ?>>Usuário</option>
                <option value="admin" <?= ($usuario['role'] ?? '')=='admin'?'selected':'' ?>>Admin</option>
            </select>
        </div>

        <!-- Botão -->
        <button type="submit" class="btn btn-primary float-end">
            <i class="fa-solid fa-save"></i> Salvar Alterações
        </button>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
