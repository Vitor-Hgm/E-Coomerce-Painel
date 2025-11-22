<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Login</title>

    <link rel="stylesheet" href="/E-Coomerce-Painel/public/css/style.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="login-bg">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-card">

            <div class="login-icon">
                🔒
            </div>

            <h3 class="text-center mb-4">Login do Painel</h3>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger text-center">
                    <?= $erro ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/E-Coomerce-Painel/public/login/entrar">

                <!-- E-mail -->
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <!-- Senha com botão de mostrar -->
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <div class="input-group">
                        <input type="password" name="senha" id="senha" class="form-control" required>

                        <span class="input-group-text" id="toggleSenha" style="cursor:pointer;">
                            <i class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Entrar</button>

            </form>

        </div>
    </div>

    <!-- Script para mostrar/ocultar senha -->
    <script>
        const input = document.getElementById("senha");
        const toggle = document.getElementById("toggleSenha");
        const icon = toggle.querySelector("i");

        toggle.addEventListener("click", () => {
            const mostrar = input.type === "password";
            input.type = mostrar ? "text" : "password";

            icon.classList.remove(mostrar ? "fa-eye" : "fa-eye-slash");
            icon.classList.add(mostrar ? "fa-eye-slash" : "fa-eye");
        });
    </script>

</body>
</html>
