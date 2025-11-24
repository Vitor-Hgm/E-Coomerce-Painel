<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Acesso Negado - Erro 403</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: "Segoe UI";
}

.error-box {
    text-align: center;
    padding: 40px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.error-box h1 {
    font-size: 90px;
    font-weight: 700;
    color: #dc3545;
}

.error-box p {
    font-size: 18px;
    color: #555;
}

.btn-custom {
    border-radius: 8px;
    padding: 10px 18px;
}
</style>
</head>

<body>
<div class="error-box">
    <h1>403</h1>
    <h3>Acesso Negado</h3>
    <p>Você não tem permissão para acessar esta área do sistema.</p>

    <a href="/E-Coomerce-Painel/public/" class="btn btn-primary btn-custom">
        Voltar para o início
    </a>
</div>
</body>
</html>
