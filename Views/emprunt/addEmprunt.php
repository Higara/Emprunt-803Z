<?php
if(!isset($_SESSION['connecte'])) { 
    echo "Vous n'êtes pas autorisé à accéder à cette page";
  }
else { 
  ?>
  <div id="shadow-form">
<h1>Ajouter un emprunt</h1>
  <form action="?controller=Emprunt&action=addSave" method="POST" enctype = "multipart/form-data">
    <div class="form-row">
      <label>Objet</label>
      <div class="textbox">
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
    <div class="form-row">
      <label>Date de début</label>
      <div class="textbox">
        <input type="date" name="date_debut" placeholder="Id User" />
      </div>
    </div>
    <div class="form-row">
      <label>Date de fin</label>
      <div class="textbox">
        <input type="date" name="date_fin" placeholder="Id User" />
      </div>
    </div>
    <div class="form-row">
      <label>Projet</label>
      <div class="textbox">
         <select name="id_projet">
        <?php 
          //On va récuperer la liste de projets pour créer une liste déroulante
           foreach ($listProjet as $projet) {
            echo '<option value="'.$projet->id_projet.'">'.$projet->nom.'</option>';
           }
        ?>
        </select>
      </div>
    </div>
    <div class="form-row">
      <label>Remarques</label>
      <div class="textbox">
        <input type="text" name="remarques" placeholder="Remarques"/></input>
      </div>
    </div>
    <div>
      <div></div>
      <div class="form-row">
        <button>Enregistrer</button>
        <button><a href="{{ url('/803Z') }}">Annuler</a></button>
      </div>

    </div>
  </form>
  </div>
<?php 

}

?>