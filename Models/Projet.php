<?php


class Projet
{
	 protected $allowed_properties = [ 'id_projet', 'id_user', 'nom', 'description',];
   protected $property = [];
	 protected $pk_name = 'id_projet';

  public $id_projet;
  public $id_user;
  public $nom;
  public $description;


	public static function get( $id_projet ) {
    //Récupérer les données d'un projet pour en faire un objet
    $projet = new Projet();
    $db = Db::getInstance();
    $sql = "SELECT * FROM projets WHERE id_projet = '".$id_projet."'";
    $sth = $db->prepare($sql);
    $sth->execute();
    //si le projet existe effectivement
    if($sth->fetch() !== false){
      $sth->execute();
      $projet->hydrate($sth->fetch());
      return $projet;
    }
    else {
      return 0;
    }
  }



  public static function getList() {
    //récupérer la liste complète des projets
    $list = [];
    //on ouvre l'accès à la bdd
    $db = Db::getInstance();
    $sql = 'SELECT * FROM projets';
    $sth = $db->prepare($sql);
    $sth->execute();

    // Recuperer une liste d'objet projet
    foreach($sth->fetchAll() as $projet) {
      $curr = new Projet();
      $curr->hydrate($projet);
      $list[] = $curr;
    }

    return $list;
   }



   public static function getByUser($id_user){
    //récupérer tous les projets d'un utilisateur
    $list = [];
    //on ouvre l'accès à la bdd
    $db = Db::getInstance();

    //On a deux requêtes sql pour pouvoir afficher également les projets auxquels on participe
    $sql = 'SELECT * FROM projets WHERE id_user = '.$id_user;
    $sth = $db->prepare($sql);
    $sth->execute();
    $verif = sizeof($sth->fetchAll());

    $sql2 = "SELECT * FROM projets, participants WHERE participants.id_user = ".$id_user." AND projets.id_projet = participants.id_projet";
    $sth2 = $db->prepare($sql2);
    $sth2->execute();
    $verif2 = sizeof($sth2->fetchAll());

    //on regarde si il a au moins un projet
    if($verif == 0 && $verif2 == 0){
      echo "Vous n'avez aucun projet !";
      return 0;
    }

    //on réexécute pour récupérer les valeurs
     $sth->execute();
     $sth2->execute();

    // Récuperer une liste d'objet projet
    foreach($sth->fetchAll() as $projet) {
      $curr = new Projet();
      $curr->hydrate($projet);
      $list[] = $curr;
    }
    foreach($sth2->fetchAll() as $projet) {
      $curr = new Projet();
      $curr->hydrate($projet);
      $list[] = $curr;
    }

    return $list;

  }
   

  public static function verifUser($id_projet){
    //on vérifie que le projet appartient bien à l'utilisateur OU que l'utilisateur est un admin
      $projet = Projet::get($id_projet);
      if($projet !== 0 && $projet->id_user == $_SESSION['id'] || $_SESSION['statut'] == '2' || $_SESSION['statut'] == '3'){
          return 1 ;
      }
      else {
        return 0;
      }
   }


   public static function getParticipants($id_projet){
    //on récupère les participants à un projet (mais pas son créateur ?)
    $listParticipants = [];
    //on ouvre l'accès à la bdd
    $db = Db::getInstance();
    $sql = 'SELECT * FROM users, participants WHERE users.id_user = participants.id_user AND participants.id_projet = '.$id_projet;
    $sth = $db->prepare($sql);
    $sth->execute();

    // Recuperer une liste d'objet projet
    foreach($sth->fetchAll() as $user) {
      $curr = new User();
      $curr->hydrate($user);
      $listParticipants[] = $curr;
    }

    return $listParticipants;
   }



  public function hydrate(array $data)
  {
    $this->id_user = $_SESSION['id'];
    //remplis les attributs de l'objet avec un array
     foreach($data as $property => $value){
       $this->$property = $value;
     }
  }

   public function getProperties(){
    //permet de retourner les attributs sous forme d'un string pour injection directe dans le sql
    //note : ne sert que dans le cadre du add
      $prop="('".$this->id_user."', '".addslashes($this->nom)."','".addslashes($this->description)."')";
      echo $prop;
      return $prop;
   }

}