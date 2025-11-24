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
            transition: all 0.3s;
            z-index: 999;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .logo-area {
            text-align: center;
            padding: 20px 10px;
            border-bottom: 1px solid #1f2937;
            transition: all 0.3s;
        }

        .sidebar.collapsed .logo-area h3 {
            display: none;
        }

        .sidebar .logo-area i {
            font-size: 28px;
        }

        .menu a {
            display: flex;
            align-items: center;
            color: #d1d5db;
            padding: 14px 22px;
            font-size: 16px;
            text-decoration: none;
            transition: 0.2s;
        }

        .menu a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .menu a:hover,
        .menu .active {
            background: #1f2937;
            color: #ffffff;
            border-radius: 8px;
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
            transition: all 0.3s;
        }

        .topbar .username {
            font-weight: 500;
        }

        .topbar .role {
            font-size: 14px;
            color: #6b7280;
        }

        .topbar.collapsed {
            margin-left: 70px;
        }

        /* CONTEÚDO */
        .content {
            margin-left: 260px;
            padding: 30px;
            transition: all 0.3s;
        }

        .content.collapsed {
            margin-left: 70px;
        }

        /* FOOTER */
        footer {
            margin-left: 260px;
            background: #111827;
            color: #ccc;
            padding: 18px;
            text-align: center;
            margin-top: 40px;
            transition: all 0.3s;
        }

        footer.collapsed {
            margin-left: 70px;
        }

        /* CARDS */
        .card-stats {
            border: none;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 6px #00000015;
            transition: transform 0.2s;
        }

        .card-stats:hover {
            transform: translateY(-5px);
        }

        .card-stats i {
            font-size: 32px;
            opacity: .8;
        }

        .card-blue {
            background: #3b82f6;
            color: white;
        }

        .card-green {
            background: #10b981;
            color: white;
        }

        .card-yellow {
            background: #facc15;
            color: #111827;
        }

        /* SMALL LISTS */
        .small-list {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 6px #00000015;
        }

        .small-list h5 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .toggle-btn {
            display: none;
            background: #111827;
            border: none;
            color: white;
            font-size: 18px;
            padding: 6px 12px;
            border-radius: 6px;
        }

        @media (max-width: 992px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.collapsed {
                left: 0;
            }

            .topbar {
                margin-left: 0;
            }

            .topbar.collapsed {
                margin-left: 260px;
            }

            .content {
                margin-left: 0;
            }

            .content.collapsed {
                margin-left: 260px;
            }

            .toggle-btn {
                display: block;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="logo-area">
            <i class="fa-solid fa-store fa-2x"></i>
            <h3>Ecommerce-Painel</h3>
        </div>

        <div class="menu">
            <a href="/E-Coomerce-Painel/public/index/index" class="active"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            <a href="/E-Coomerce-Painel/public/categoria/index"><i class="fa-solid fa-tags"></i> Categorias</a>
            <a href="/E-Coomerce-Painel/public/produto/index"><i class="fa-solid fa-box"></i> Produtos</a>
            <a href="/E-Coomerce-Painel/public/usuario/index"><i class="fa-solid fa-users"></i> Usuários</a>
        </div>
    </aside>

    <!-- HEADER -->
    <header class="topbar d-flex align-items-center justify-content-between" id="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="toggle-btn" id="toggleSidebar"><i class="fa-solid fa-bars"></i></button>
            <h5 class="m-0 fw-bold">Dashboard</h5>
        </div>

        <div class="d-flex align-items-center gap-3">
            <div>
                <span class="username"><?= htmlspecialchars($usuario["name"]) ?></span><br>
                <span class="role"><?= ucfirst($usuario["role"]) ?></span>
            </div>

            <a href="/E-Coomerce-Painel/public/login/sair" class="btn btn-outline-danger btn-sm">
                <i class="fa-solid fa-right-from-bracket"></i> Sair
            </a>
        </div>
    </header>

    <!-- CONTEÚDO -->
    <main class="content" id="content">
        <div class="row g-4">

            <div class="col-md-4">
                <div class="card card-stats card-blue">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="fw-bold">1.240</h4>
                            <p>Produtos cadastrados</p>
                        </div>
                        <i class="fa-solid fa-box"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stats card-green">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="fw-bold">320</h4>
                            <p>Usuários ativos</p>
                        </div>
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-stats card-yellow">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="fw-bold">R$ 87.550</h4>
                            <p>Vendas no mês</p>
                        </div>
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div>
            </div>

        </div>

        <hr class="my-5">

        <div class="row g-4">
            <div class="col-md-6">
                <div class="small-list">
                    <h5>Últimos produtos cadastrados</h5>
                    <ul class="list-unstyled mb-0">
                        <li>Produto 1</li>
                        <li>Produto 2</li>
                        <li>Produto 3</li>
                        <li>Produto 4</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="small-list">
                    <h5>Últimos usuários cadastrados</h5>
                    <ul class="list-unstyled mb-0">
                        <li>Usuário 1</li>
                        <li>Usuário 2</li>
                        <li>Usuário 3</li>
                        <li>Usuário 4</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer id="footer">
        Desenvolvido por Vitor Hugo e equipe
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const topbar = document.getElementById('topbar');
        const footer = document.getElementById('footer');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
            topbar.classList.toggle('collapsed');
            footer.classList.toggle('collapsed');
        });
    </script>
</body>

</html>
