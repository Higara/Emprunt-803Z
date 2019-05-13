<?php
if(!isset($_SESSION['connecte']) || $_SESSION['statut']=='1') { 
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
<h1>Ajouter un matériel</h1>
  <form action="?controller=Materiel&action=addSave" method="POST" enctype = "multipart/form-data">
    <div class="form-group row">
      <label class="col-2 col-form-label">ref_objet</label>
      <div class="col-5">
        <input type="text" name="ref_objet" class="form-control" placeholder="Référence Objet" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">nom_objet</label>
      <div class="col-5">
        <input type="text" name="nom_objet" class="form-control" placeholder="Nom Objet" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">id_type</label>
      <div class="col-5">
        <input type="text" name="id_type" class="form-control" placeholder="Id Type" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Description</label>
      <div class="col-10">
        <textarea type="text" name="description" class="form-control" placeholder="Description"/></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Etat</label>
      <div class="col-10">
        <textarea type="text" name="etat" class="form-control" placeholder="Etat"/></textarea>
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

} 

?>