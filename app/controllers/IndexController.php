<?php
namespace app\Controllers;

use app\Core\Auth;

class IndexController
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function index()
    {
        Auth::check();        // usuário precisa estar logado
        Auth::requireAdmin(); // apenas admin acessa

        require __DIR__ . "/../views/index/index.php";
    }
}
