<div class="container">
<h1>Inscription</h1>
  <form action="?controller=User&action=addSave" method="POST" enctype = "multipart/form-data">
    <div class="form-group row">
      <label class="col-2 col-form-label">Nom</label>
      <div class="col-5">
        <input type="text" name="nom" class="form-control" placeholder="Nom" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Prénom</label>
      <div class="col-5">
        <input type="text" name="prenom" class="form-control" placeholder="Prénom" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">id_filiere</label>
      <div class="col-5">
        <input type="number" name="id_filiere" class="form-control" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Date de Naissance</label>
      <div class="col-5">
        <input type="date" name="date_naissance" class="form-control" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Adresse</label>
      <div class="col-5">
        <input type="text" name="adresse" class="form-control" placeholder="Adresse" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Mail</label>
      <div class="col-5">
        <input type="text" name="mail" class="form-control" placeholder="Mail" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Mot de passe</label>
      <div class="col-5">
        <input type="text" name="password" class="form-control" placeholder="Mot de passe" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-2 col-form-label">Téléphone</label>
      <div class="col-5">
        <input type="text" name="telephone" class="form-control" placeholder="0600000000" />
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

