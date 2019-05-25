<?php

  if(isset($_SESSION['connecte'])) { 
    echo "Déjà connecté !";
    }
 else {
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="Views/assets/css/style.css">
  </head>
  <body>
<div class="login-box">
  <a href="http://www.803z.fr/"><img id="logo" src="Views/assets/img/logo_alpha.png" alt="Site de 803Z"></a>
  <h1>Connexion</h1>
  <form action="?controller=User&action=sessionStart" method="POST" enctype = "multipart/form-data">
    <div class="textbox">
      <i class="fas fa-user"></i>
      <input type="text" name="mail" placeholder="Identifiant">
    </div>

    <div class="textbox">
      <i class="fas fa-lock"></i>
      <input type="password" name="password" placeholder="Mot de passe">
    </div>

    <button class="btn">Se connecter</button>
  </form>

</div>
  </body>
</html>

 <?php }
 
?>
