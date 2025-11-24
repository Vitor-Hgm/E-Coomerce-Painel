<?php $usuario = $_SESSION["ecoomercepainel"] ?? null; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Ecommerce Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .dashboard-header {
            padding: 20px;
            background: #1f2937;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header h2 {
            font-size: 22px;
            font-weight: 600;
        }

        .dashboard-header a.btn {
            font-weight: 500;
        }

        .table-container {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            vertical-align: middle !important;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.5em 0.75em;
        }

        .btn-sm {
            padding: 0.35rem 0.6rem;
            font-size: 0.85rem;
        }


        /* BOTÃO BONITO DE VOLTAR */
        .btn-voltar {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            font-size: 16px;
            border-radius: 10px;
            background: linear-gradient(135deg, #4b5563, #1f2937);
            color: white;
            border: none;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.25);
            text-decoration: none;
            transition: 0.25s ease;
        }

        .btn-voltar:hover {
            background: linear-gradient(135deg, #6b7280, #374151);
            transform: translateY(-2px);
            color: white;
        }
    </style>
</head>

<body class="p-4">

    <a href="/E-Coomerce-Painel/public/index" class="btn-voltar mb-3">
        <i class="fa-solid fa-arrow-left"></i> Voltar ao Dashboard
    </a>


    <div class="dashboard-header">
        <h2>Categorias</h2>
        <a href="/E-Coomerce-Painel/public/categoria/create" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Nova Categoria
        </a>
    </div>

    <div class="table-container">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Slug</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?= $categoria['id'] ?></td>
                        <td><?= htmlspecialchars($categoria['name']) ?></td>
                        <td><?= htmlspecialchars($categoria['slug']) ?></td>
                        <td>
                            <?php if ($categoria['active']): ?>
                                <span class="badge bg-success"><i class="fa-solid fa-check"></i> Ativo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><i class="fa-solid fa-xmark"></i> Inativo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/E-Coomerce-Painel/public/categoria/edit/<?= $categoria['id'] ?>" class="btn btn-sm btn-warning">
                                <i class="fa-solid fa-pen"></i> Editar
                            </a>
                            <a href="#" class="btn btn-sm btn-danger" onclick="excluirCategoria(<?= $categoria['id'] ?>)">
                                <i class="fa-solid fa-trash"></i> Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function excluirCategoria(id) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/E-Coomerce-Painel/public/categoria/delete/${id}`;
                }
            });
        }

        <?php if (isset($_GET['excluido']) && $_GET['excluido'] == 1): ?>
            Swal.fire({
                title: 'Excluído!',
                text: 'Categoria excluída com sucesso.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>

</body>

</html>