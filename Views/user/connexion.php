<?php

  if(isset($_SESSION['connecte'])) { 
   //header('Location:/dev.gallery.fr/admin/liste');
  	echo "connecté !";
    //exit();
  	}
 else {
?>
  <h2> Veuillez vous identifier</h2>
<form action="?controller=User&action=sessionStart" method="POST" enctype = "multipart/form-data">
	<div class="form-group row">
		<div class="col-2 col-form-label">Mail</div>
		<div class="col-5">
			<input type="text" name="mail" class="form-control" placeholder="mail" />
		</div>
	</div>
	<div class="form-group row">
		<div class="col-2 col-form-label">Mot de passe</div>
		<div class="col-5">
			<input type="text" name="password" class="form-control" placeholder="password" />
		</div>
	</div>
	<div>
		<button class="btn btn-outline-primary">Se connecter</button>
        <a href="{{ url('/') }}" class="btn btn-link">Retour</a>
    </div>

 <?php }
 
?>
