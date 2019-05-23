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


  require_once('Views/layout.php');
?>


