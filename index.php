<?php
  require_once('config.php');

  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
   	if(isset($_GET['id'])){
   		$id = $_GET['id'];
   	}
   	else {
   		$id=null;
   	}
  } 

  else {
    $controller = 'User';
    $action     = 'connexion';
    $id=null;
  }
/*
$request = $_SERVER['REDIRECT_URL'];

switch ($request) {
    case '/' :
        $controller = 'User';
        $action     = 'connexion';
        $id=null;
        break;

    case '' :
        $controller = 'User';
        $action     = 'connexion';
        $id=null;
        break;

    case '/User/Connexion' :
        require __DIR__ . '/views/about.php';
        break;

    default:
        require __DIR__ . '/views/404.php';
        break;
*/


  require_once('Views/layout.php');
?>