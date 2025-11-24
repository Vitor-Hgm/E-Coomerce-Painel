<?php
namespace app\Core;

class Auth
{
    public static function check()
    {
        if (!isset($_SESSION["ecoomercepainel"])) {
            header("Location: /E-Coomerce-Painel/public/login");
            exit;
        }
    }

    public static function isAdmin()
    {
        self::check();

        return isset($_SESSION["ecoomercepainel"]["role"]) 
            && $_SESSION["ecoomercepainel"]["role"] === "admin";
    }

    public static function requireAdmin()
    {
        if (!self::isAdmin()) {

            // Define o código HTTP 403 Forbidden
            http_response_code(403);

            // Carrega a página de erro
            require __DIR__ . "/../views/errors/403.php";
            exit;
        }
    }
}
