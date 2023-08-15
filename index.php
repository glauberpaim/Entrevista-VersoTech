<div>
<?php
require "models/userModel.php";

require "views/fragmento/topo.php";
require "views/fragmento/main.php";

// Autoload das classes usando namespaces
 spl_autoload_register(function ($className) {
     $caminho = './controllers/'. $className. '.php';
     if(file_exists($caminho)){
     	require_once "{$caminho}";
     }
 });

$route = $_GET['controller'] ?? '';
$parts = explode('/', $route);
$controllerName = array_shift($parts) . 'Controller';
$action = isset($_GET['action']) ? $_GET['action'] : 'index' ;


$controllerClass = $controllerName;
$controller = new $controllerClass();

// Chamada da ação do Controller
if (method_exists($controller, $action) && !empty($action)) {
    if(isset($_GET['id'])){
    	$controller->$action($_GET['id']);
	}else{
		$controller->$action();
	}
} else {
    echo 'Página não encontrada';
    echo "<script>setTimeout(window.location = 'index', 1000)</script>";
}

require 'views/fragmento/rodape.php'; 
?>