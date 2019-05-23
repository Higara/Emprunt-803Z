<?php
  function call($controller, $action, $id) {
    require_once('Controllers/' . $controller . 'Controller.php');

    switch($controller) {
      case 'Materiel':
        require_once('Models/Materiel.php');
        $controller = new MaterielController();
        if(isset($id)){
          $controller->ref_objet = $id;
        }
      break;
      case 'Emprunt':
        require_once('Models/Emprunt.php');
        $controller = new EmpruntController();
        if(isset($id)){
          $controller->ref_emprunt = $id;
        }
      break;
      case 'User':
        require_once('Models/User.php');
        $controller = new UserController();
        if(isset($id)){
          $controller->id_user = $id;
        }
      break;
      case 'Projet':
        require_once('Models/Projet.php');
        $controller = new ProjetController();
        if(isset($id)){
          $controller->id_projet = $id;
        }
      break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array(//'pages' => ['home', 'error'],
                       //'posts' => ['index', 'show'],
                      'Materiel' => ['index', 'add', 'addSave', 'edit', 'editSave', 'delete', 'show'],

                      'Emprunt' => ['index', 'add', 'addSave', 'edit', 'editSave', 'delete', 'show', 'showAll'],

                      'User' => ['index', 'add', 'addSave', 'edit', 'editSave', 'delete', 'show', 'connexion', 'sessionStart', 'deconnexion', 'liste'],

                      'Projet' => ['index', 'add', 'addSave', 'edit', 'editSave', 'delete', 'addParticipant', 'addSaveParticipant']);

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action, $id);
    } else {
      //call('pages', 'error');
      echo "Erreur 404";
    }
  } else {
    echo "Erreur 404";
    //call('pages', 'error');
  }
?>