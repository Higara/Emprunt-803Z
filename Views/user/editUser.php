<?php

if(!isset($_SESSION['connecte'])) { 
    echo "Vous n'êtes pas autorisé à accéder à cette page";
  }
else { 
  ?>

<div class="container">
<h1>Modifier le profil</h1>
  <form action="?controller=User&action=editSave&id=<?php echo $user->id_user;?>" method="POST" enctype = "multipart/form-data">
    <div class="form-group row">
      <label class="col-2 col-form-label">Nom</label>
      <div class="col-5">
        <input type="text" name="nom" class="form-control" placeholder="Nom" value="<?php echo $user->nom;?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Prénom</label>
      <div class="col-5">
        <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="<?php echo $user->prenom;?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">id_filiere</label>
      <div class="col-5">
        <input type="number" name="id_filiere" class="form-control" value="<?php echo $user->id_filiere;?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Date de Naissance</label>
      <div class="col-5">
        <input type="date" name="date_naissance" class="form-control" value="<?php echo $user->date_naissance;?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Adresse</label>
      <div class="col-5">
        <input type="text" name="adresse" class="form-control" placeholder="Adresse" value="<?php echo $user->adresse;?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Mail</label>
      <div class="col-5">
        <input type="text" name="mail" class="form-control" placeholder="Mail" value="<?php echo $user->mail;?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Mot de passe</label>
      <div class="col-5">
        <input type="text" name="password" class="form-control" placeholder="Mot de passe" value="<?php echo $user->password;?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Téléphone</label>
      <div class="col-5">
        <input type="text" name="telephone" class="form-control" placeholder="0600000000" value="<?php echo $user->telephone;?>"/>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-2"></div>
      <div class="col-10">
        <button class="btn btn-success">Enregistrer</button>
        <a href="{{ url('/') }}" class="btn btn-link">Annuler</a>
        <a href="?controller=User&action=delete&id=<?php echo $user->id_user;?>" class="btn btn-danger">Supprimer</a>
      </div>

    </div>
  </form>
</div>


<?php 

}

?>