<?php
$usuario = $_SESSION["ecoomercepainel"] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel E-Commerce</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #111827;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
            color: white;
        }

        .sidebar .logo-area {
            text-align: center;
            padding: 20px 10px;
            border-bottom: 1px solid #1f2937;
        }

        .sidebar .logo-area h3 {
            margin-top: 10px;
            font-size: 20px;
            font-weight: 600;
        }

        .menu a {
            display: block;
            color: #d1d5db;
            padding: 14px 22px;
            font-size: 16px;
            text-decoration: none;
            transition: 0.2s;
        }

        .menu a:hover,
        .menu .active {
            background: #1f2937;
            color: #ffffff;
        }

        /* HEADER */
        .topbar {
            margin-left: 260px;
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            padding: 0 25px;
            box-shadow: 0 2px 4px #00000015;
            justify-content: space-between;
        }

        .topbar .username {
            font-weight: 500;
        }

        /* CONTEÚDO */
        .content {
            margin-left: 260px;
            padding: 30px;
        }

        /* FOOTER */
        footer {
            margin-left: 260px;
            background: #111;
            color: #ccc;
            padding: 18px;
            text-align: center;
            margin-top: 40px;
        }

        /* CARDS */
        .card-stats {
            border: none;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 6px #00000015;
        }

        .card-stats i {
            font-size: 32px;
            opacity: .7;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo-area">
            <i class="fa-solid fa-store fa-2x"></i>
            <h3>Ecommerce-Painel</h3>
        </div>

        <div class="menu">
            <a href="#" class="active"><i class="fa-solid fa-chart-line me-2"></i> Dashboard</a>
            <a href="#"><i class="fa-solid fa-tags me-2"></i> Categorias</a>
            <a href="#"><i class="fa-solid fa-box me-2"></i> Produtos</a>
            <a href="#"><i class="fa-solid fa-users me-2"></i> Usuários</a>
        </div>
    </aside>

    <!-- HEADER -->
    <header class="topbar">
        <h5 class="m-0 fw-bold">Dashboard</h5>

        <div class="d-flex align-items-center gap-3">
            <span class="username">Olá, <?= htmlspecialchars($usuario["name"]) ?></span>

            <a href="/E-Coomerce-Painel/public/login/sair" class="btn btn-outline-danger btn-sm">
                <i class="fa-solid fa-right-from-bracket"></i> Sair
            </a>
        </div>
    </header>

    <!-- CONTEÚDO -->
    <main class="content">

        <div class="row g-4">

            <!-- CARD 1 -->
            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="fw-bold">1.240</h4>
                            <p class="text-muted">Produtos cadastrados</p>
                        </div>
                        <i class="fa-solid fa-box"></i>
                    </div>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="fw-bold">320</h4>
                            <p class="text-muted">Usuários ativos</p>
                        </div>
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="col-md-4">
                <div class="card card-stats">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="fw-bold">R$ 87.550</h4>
                            <p class="text-muted">Vendas no mês</p>
                        </div>
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div>
            </div>

        </div>

        <hr class="my-5">

        <h4 class="fw-bold">Visão geral</h4>
        <p class="text-muted">Aqui você pode gerenciar categorias, produtos e usuários.</p>

    </main>

    <!-- FOOTER -->
    <footer>
        Desenvolvido por Vitor Hugo e equipe
    </footer>

</body>

</html>
