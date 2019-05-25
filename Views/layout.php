<?php
  session_start();
  if(!isset($_SESSION['connecte'])) { 
    require_once('routes.php');
  }
  else{
?>


<!doctype html>
<html><head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>803Z</title>
  <meta charset="utf-8">
  
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta http-equiv="cleartype" content="on">
  <link href="Views/assets/css/style_principal.css" rel="stylesheet">
  <script src="../../resources/assets/external/requirejs/require.js"></script>
  <script src="Views/assets/js/event.js"></script>
  
</head>
<body style="overflow: auto;">



  <header>
        <span class="panel-button" data-panel="panel1"></span>


        <a href="http://www.803z.fr/"><img id="logo" src="./img/803Z.jpg" alt="Site de 803Z"></a>
    </header>

    <div id="panel1">
        <div style="margin: 26px 0px; text-align: center;">
        </div>
        <div id="accordion">
            <ul>


                <li>
                    <div>L'association</div>
                    <ul>
                        <li><a href="">En bref</a></li>
                        <li><a href="">Politique des emprunts</a></li>
                    </ul>


                <li>
                    <div>Emprunts</div>
                    <ul>
                        <li><a href="?controller=Emprunt&action=index">Mes emprunts</a></li>
                        <li><a href="?controller=Materiel&action=index">Matériel disponible</a></li>
                        <li><a href="">Calendrier</a></li>
                    </ul>
                </li>

                <?php

                  if($_SESSION['statut'] == '2' || $_SESSION['statut'] == '3') { 

                ?>

                <li>
                  <div> Administateur </div>
                  <ul>
                    <li><a href="?controller=Emprunt&action=showAll">Tous les emprunts</a></li>
                    <li><a href="?controller=Projet&action=showAll">Tous les projets</a></li>
                    <li><a href="?controller=User&action=showAll">Tous les utilisateurs</a></li>
                  </ul>
                </li>

                <?php } ?>

                <li>
                    <div>Mon Compte</div>
                    <ul>
                        <li>
                            <div>Profil</div>
                            <ul>
                                <li><a href="?controller=User&action=index">Consulter</a></li>
                                <li><a href="?controller=User&action=edit&id=<?php echo $_SESSION['id']?>">Modifier</a></li>
                            </ul>
                        </li>
                        <li>
                            <div>Paramètres</div>
                            <ul>
                              <li><a href='?controller=User&action=deconnexion'>Se déconnecter</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div><ul><li><a href='?controller=User&action=deconnexion'>Se déconnecter</a></li></ul></div>
                </li>
            </ul>
        </div>
    </div>



<!--Error Popup-->
<div id="popup">
  <button class="close" id="closePopup" aria-label="Close" type="button" data-dismiss="modal"><span aria-hidden="true">×</span></button>
  <p id="popupText"></p>
</div>


    <?php

       require_once('routes.php');
      }
    ?>


</body></html>