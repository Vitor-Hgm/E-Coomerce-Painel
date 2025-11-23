<?php $usuario = $_SESSION["ecoomercepainel"] ?? null; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria - Ecommerce Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        /* HEADER */
        .dashboard-header {
            padding: 20px;
            background: #111827;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .dashboard-header h2 {
            font-size: 22px;
            font-weight: 600;
        }

        .dashboard-header a.btn {
            font-weight: 500;
        }

        /* CARD FORM */
        .card-form {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        .card-form h3 {
            margin-bottom: 20px;
            font-weight: 600;
            color: #111827;
        }

        /* FORM GROUPS */
        .form-label {
            font-weight: 500;
        }

        input.form-control,
        textarea.form-control {
            border-radius: 8px;
            padding: 12px;
        }

        button.btn-primary {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }

        button.btn-primary i {
            margin-right: 5px;
        }
    </style>
</head>

<body class="p-4">

    <div class="dashboard-header">
        <h2>Editar Categoria</h2>
        <a href="/E-Coomerce-Painel/public/categoria/index" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>

    <div class="card-form">
        <h3>Atualize os detalhes da categoria</h3>
        <form action="/E-Coomerce-Painel/public/categoria/update/<?= $categoria['id'] ?>" method="POST">
            
            <!-- Nome -->
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" 
                       value="<?= htmlspecialchars($categoria['name']) ?>" required>
            </div>

            <!-- Slug -->
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" 
                       value="<?= htmlspecialchars($categoria['slug']) ?>" required>
                <small class="text-muted">Será gerado automaticamente conforme o nome.</small>
            </div>

            <!-- Ativo -->
            <div class="form-check mb-3">
                <input type="checkbox" name="active" id="active" class="form-check-input" value="1"
                       <?= $categoria['active'] ? 'checked' : '' ?>>
                <label for="active" class="form-check-label">Ativo</label>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para gerar slug automaticamente -->
    <script>
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        nameInput.addEventListener('input', function () {
            let slug = nameInput.value.toLowerCase().trim();
            slug = slug.replace(/[^a-z0-9-]+/g, '-');
            slug = slug.replace(/-+/g, '-');
            slugInput.value = slug;
        });
    </script>
</body>

</html>
