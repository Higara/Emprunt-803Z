<?php

  //connexion à la base de données à travers la classe Db
  require_once('config_local.php');


  //récupérer les paramètres de l'URL
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

  //on renvoie vers la page layout qui contient le routeur
  require_once('Views/layout.php');
?>


