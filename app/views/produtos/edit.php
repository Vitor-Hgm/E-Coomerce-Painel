<?php $usuario = $_SESSION["ecoomercepainel"] ?? null; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Produto - Ecommerce Painel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
<style>
body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
.dashboard-header { padding: 20px; background: #111827; color: #fff; display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-radius:8px; }
.dashboard-header h2 { font-size: 22px; font-weight:600; }
.card-form { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 800px; margin:auto; }
.card-form h3 { margin-bottom: 20px; font-weight: 600; color: #111827; }
.form-label { font-weight: 500; }
input.form-control, select.form-control, textarea.form-control { border-radius: 8px; padding: 12px; }
button.btn-primary { border-radius: 8px; padding: 10px 20px; font-weight: 500; }
button.btn-primary i { margin-right: 5px; }
img#preview { width: 100px; height: 100px; object-fit: cover; border-radius: 8px; margin-bottom: 10px; }
</style>
</head>
<body class="p-4">

<div class="dashboard-header">
    <h2>Editar Produto</h2>
    <a href="/E-Coomerce-Painel/public/produto" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="card-form">
    <h3>Atualize os detalhes do produto</h3>
    <form action="/E-Coomerce-Painel/public/produto/update/<?= $produto['id'] ?>" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($produto['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value="<?= htmlspecialchars($produto['slug']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Selecione</option>
                <?php foreach($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $produto['category_id'] == $c['id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Preço</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?= $produto['price'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Quantidade em Estoque</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" value="<?= $produto['stock_quantity'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea name="description" id="description" class="form-control"><?= htmlspecialchars($produto['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagem Atual</label><br>
            <?php if(!empty($produto['image'])): ?>
                <img src="/E-Coomerce-Painel/public/uploads/<?= $produto['image'] ?>" id="preview" alt="Imagem do Produto">
            <?php else: ?>
                <img src="/E-Coomerce-Painel/public/uploads/default.png" id="preview" alt="Sem imagem">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Nova Imagem</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="active" id="active" class="form-check-input" <?= $produto['active'] ? 'checked' : '' ?>>
            <label for="active" class="form-check-label">Ativo</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="featured" id="featured" class="form-check-input" <?= $produto['featured'] ? 'checked' : '' ?>>
            <label for="featured" class="form-check-label">Destaque</label>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Salvar Alterações</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function(){
    $('#description').summernote({
        placeholder: 'Digite a descrição do produto...',
        tabsize: 2,
        height: 150
    });
});
</script>

</body>
</html>
