<?php
session_start();

// Autoload simples
spl_autoload_register(function($class){
    if (file_exists("../app/controllers/" . $class . ".php")) {
        require "../app/controllers/" . $class . ".php";
    }
    if (file_exists("../app/models/" . $class . ".php")) {
        require "../app/models/" . $class . ".php";
    }
});

// Router básico
$param = $_GET['param'] ?? 'index/index';
list($controller, $method) = explode('/', $param);

$controller = ucfirst($controller) . "Controller";

if (class_exists($controller) && method_exists($controller, $method)) {
    $c = new $controller;
    $c->$method();
} else {
    echo "Página não encontrada.";
}
