<?php
  session_start();
?>

<DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- @@@ CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <header>
      <a href='?controller=Materiel&action=index'>Voir le matériel</a>

      <?php 
      if(!isset($_SESSION['connecte'])) { ?>
        <a href='?controller=User&action=add'>Inscription</a>
        <a href='?controller=User&action=connexion'>Se connecter</a>
      <?php 
      } 
      else 
      { 
          if($_SESSION['statut']=='2' || $_SESSION['statut']=='3')
          { ?>
              <a href='?controller=Materiel&action=edit'>Modifier le matériel</a>
              <a href='?controller=Materiel&action=add'>Ajout de materiel</a>
          <?php 
          } ?>
        <a href='?controller=Emprunt&action=add'>Faire une demande d'emprunt</a>
        <a href='?controller=User&action=edit&id=<?php echo $_SESSION['id']?>'>Modifier le profil</a>
        <a href='?controller=User&action=deconnexion'>Se déconnecter</a>
      <?php 
      } ?>
    </header>

    <?php
     require_once('routes.php'); 
    ?>

    <footer>
    </footer>
  <body>
<html>