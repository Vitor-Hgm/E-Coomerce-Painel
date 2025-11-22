<?php 
class Conexao {

    private static $host = "localhost";
    private static $user = "root";
    private static $db   = "urbanstreet_db";
    private static $pass = "";  

    public static function conectar() {
        try {
            $pdo = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8",
                self::$user, 
                self::$pass
            );

            // Modo de erro
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {
            die("<p>Erro ao conectar no banco: {$e->getMessage()}</p>");
        }
    }
}
