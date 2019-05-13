<?php
// si l'utilisateur n'est pas connecté ou qu'il n'est pas admin il n'a pas accès à la page
if(!isset($_SESSION['connecte']) || $_SESSION['statut']=='1') { 
    echo "Vous n'êtes pas autorisé à accéder à cette page";
  }
else { 
  ?>

  <div class="container">
<h1>Modifier un matériel</h1>
  <form action="?controller=Materiel&action=editSave&id=<?php echo $matos->ref_objet ?>" method="POST" enctype = "multipart/form-data">
    <div class="form-group row">
      <label class="col-2 col-form-label">ref_objet</label>
      <div class="col-5">
        <input type="text" name="ref_objet" class="form-control" placeholder="<?php echo $matos->ref_objet ?>" value="<?php echo $matos->ref_objet ?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">nom_objet</label>
      <div class="col-5">
        <input type="text" name="nom_objet" class="form-control" placeholder="<?php echo $matos->nom_objet ?>" value="<?php echo $matos->nom_objet ?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">id_type</label>
      <div class="col-5">
        <input type="text" name="id_type" class="form-control" placeholder="<?php echo $matos->id_type ?>" value="<?php echo $matos->id_type ?>"/>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Description</label>
      <div class="col-10">
        <textarea type="text" name="description" class="form-control" placeholder="<?php echo $matos->description ?>"/><?php echo $matos->description ?></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Etat</label>
      <div class="col-10">
        <textarea type="text" name="etat" class="form-control" placeholder="<?php echo $matos->etat ?>"/><?php echo $matos->etat ?></textarea>
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

<?php 

}

?>