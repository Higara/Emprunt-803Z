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
<h1>Modifier l'emprunt</h1>
  <form action="?controller=Emprunt&action=editSave&id=<?php echo $emprunt->ref_emprunt ?>" method="POST" enctype = "multipart/form-data">
    <div class="form-group row">
      <label class="col-2 col-form-label">ref_emprunt</label>
      <div class="col-5">
        <input type="text" name="ref_emprunt" class="form-control" placeholder="Référence Emprunt" value="<?php echo $emprunt->ref_emprunt ?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Objet</label>
      <div class="col-5">
        <select class="form-control" name="ref_objet">
        <?php 
          //On va récuperer la liste de matériel pour créer une liste déroulante
           foreach ($listMatos as $matos) {
            echo '<option value="'.$matos->ref_objet.'">'.$matos->nom_objet.'</option>';
           }
        ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">date_debut</label>
      <div class="col-5">
        <input type="date" name="date_debut" class="form-control" placeholder="Id User" value="<?php echo $emprunt->date_debut ?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">date_fin</label>
      <div class="col-5">
        <input type="date" name="date_fin" class="form-control" placeholder="Id User" value="<?php echo $emprunt->date_fin ?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">id_projet</label>
      <div class="col-5">
        <input type="number" name="id_projet" class="form-control" placeholder="ID Objet" value="<?php echo $emprunt->id_projet ?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">remarques</label>
      <div class="col-10">
        <textarea type="text" name="remarques" class="form-control" placeholder="<?php echo $emprunt->remarques ?>"/><?php echo $emprunt->remarques ?></textarea>
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