<?php
namespace App\Controllers;

class IndexController
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function index()
    {
        require __DIR__ . "/../views/index/index.php";
    }
}
