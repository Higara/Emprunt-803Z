<?php
if(!isset($_SESSION['connecte'])) { 
    echo "Vous n'êtes pas autorisé à accéder à cette page";
  }
else { 
  ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TEST</title>
  <!-- @@@ CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="container">
<h1>Ajouter un participant au projet</h1>
  <form action="?controller=Projet&action=addSaveParticipant" method="POST" enctype = "multipart/form-data">
    <div class="form-group row" style="display:none;">
      <label class="col-2 col-form-label">Projet :</label>
      <div class="col-5">
        <input type="number" name="id_projet" class="form-control" value="<?php echo $this->id_projet; ?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Sélectionner un participant</label>
      <div class="col-5">
        <select class="form-control" name="id_user">
        <?php 
          //On va récuperer la liste d'utilisateur pour créer une liste déroulante
           foreach ($listUser as $user) {
            echo '<option value="'.$user->id_user.'">'.$user->nom." ".$user->prenom.'</option>';
           }
        ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-2"></div>
      <div class="col-10">
        <button class="btn btn-success">Enregistrer</button>
        <a href="{{ url('/') }}" class="btn btn-link">Annuler</a>
      </div>

    </div>
  </form>
  </div>
</body>
</html>

<?php 
  $_POST['id_project'] = $projet->id_projet;

}

?>