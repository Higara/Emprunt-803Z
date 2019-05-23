<?php


class Emprunt
{
	 protected $allowed_properties = ['ref_emprunt', 'ref_objet', 'id_user', 'date_debut', 'date_fin', 'id_projet', 'remarques'];//liste des propriétés
   protected $property = [];
	 protected $pk_name = 'ref_emprunt';//clef primaire


	  public $ref_emprunt;
  	public $ref_objet;
  	public $id_user;
  	public $date_debut;
  	public $date_fin;
    public $id_projet;
    public $remarques;

	 public static function get($ref_emprunt){
    $emprunt = new Emprunt();
    $db = Db::getInstance();
    $sql = "SELECT * FROM emprunts WHERE ref_emprunt = '".$ref_emprunt."'";
    $sth = $db->prepare($sql);
    $sth->execute();
    //$nb = count($sth->fetch());
    //var_dump($sth->fetch());
    if($sth->fetch() !== false){
      $sth->execute();
      $emprunt->hydrate($sth->fetch());
      return $emprunt;
    }
    else {
      //echo "</br> Mais cette référence est déjà prise !";
      return 0;
    }

	 }

	 public static function getList(){
	 	$list = [];
    //on ouvre l'accès à la bdd
    $db = Db::getInstance();
    $sql = 'SELECT * FROM emprunts';
    $sth = $db->prepare($sql);
    $sth->execute();
    // Recuperer une liste d'objet Emprunt
    foreach($sth->fetchAll() as $emprunt) {
      $curr = new Emprunt();
      $curr->hydrate($emprunt);
      $list[] = $curr;
    }

    return $list;
	 }

   public static function getByUser($id_user){
    $list = [];
    //on ouvre l'accès à la bdd
    $db = Db::getInstance();
    $sql = 'SELECT * FROM emprunts WHERE id_user = '.$id_user;
    $sth = $db->prepare($sql);
    $sth->execute();

    // Recuperer une liste d'objet emprunt
    foreach($sth->fetchAll() as $emprunt) {
      $curr = new Emprunt();
      $curr->hydrate($emprunt);
      $list[] = $curr;
    }

    return $list;
   }

   public static function verifDispo($ref_objet, $date_debut, $date_fin){
    //on vérifie l'ordre des dates
    $debut = new DateTime($date_debut);
    $fin = new DateTime($date_fin);
    if( $fin < $debut ){
      echo "erreur dans le choix des dates </br>";
      return 0;
    }

    //on vérifie que les dates sont dans le futur
    $date_aujourdhui = new DateTime('today');
    $date = new DateTime($date_debut);
    //pas besoin de comparer date_fin car on vérifie déjà que date_fin est après date_début
    if($date<=$date_aujourdhui){
      echo "Veuillez mettre une date dans le futur</br>";
      return 0;
    }


    //on compare les dates à toutes celles des emprunts existants de l'objet
    $emprunt = new Emprunt();
    $db = Db::getInstance();
    $sql = "SELECT * FROM emprunts WHERE ref_objet = '".$ref_objet."'";
    $sth = $db->prepare($sql);
    $sth->execute();
    //si on a une réponse à la requête on vérifie, sinon il n'existe pas d'emprunt pour l'objet
    if($sth->fetch() !== false){
        $sth->execute();
        //liste des emrpunts de cet objets
        foreach($sth->fetchAll() as $emprunt) {
          $curr = new Emprunt();
          $curr->hydrate($emprunt);
          if($date_debut>=$curr->date_debut && $date_debut<=$curr->date_fin ||
              $date_fin>=$curr->date_debut && $date_fin<=$curr->date_fin) {
            echo "Le matériel est déjà pris du ".$curr->date_debut." au ".$curr->date_fin;
            return 0;
          }
          $list[] = $curr;
        }
        return 1;
    }
    else {
      return 1;
    }
   }


   public static function verifUser($ref_emprunt){
    //on vérifie que l'emprunt appartient bien à l'utilisateur OU que l'utilisateur est un admin
      $emprunt = Emprunt::get($ref_emprunt);
      if($emprunt !== 0 && $emprunt->id_user == $_SESSION['id'] || $_SESSION['statut'] == '2' || $_SESSION['statut'] == '3'){

        //on vérifie que la date n'est pas passé
        $date_aujourdhui = new DateTime('today');
        $date = new DateTime($emprunt->date_debut);
        if($date<=$date_aujourdhui){
          echo "L'emprunt a déjà commencé, pas possible de le supprimer</br>";
          return 0;
        }
        else{
          return 1 ;
        }
      }
      else {
        return 0;
      }
   }





   public function hydrate(array $data)
  {
    $this->id_user = $_SESSION['id'];
    //remplis les propriétés de l'objet avec un array, comme un $_POST 
     foreach($data as $property => $value){
       $this->$property = $value;
     }
  }

   public function getProperties(){
    //permet de retourner les propriétés sous forme d'un string pour injection directe dans le sql

      $prop="('".$this->ref_emprunt."','".$this->ref_objet."', ".$this->id_user.",'".$this->date_debut."','".$this->date_fin."',".$this->id_projet.",'".addslashes($this->remarques)."')";
      echo $prop;
      return $prop;
   }

   public function setRef(){
    //on récupère la date
    $date = getDate();

    //on construit la référence
    $annee = substr($date['year'], -2, 2);
    //echo $annee;
    $ref = $date['mday'].$date['mon'].$annee.$this->ref_objet.$this->id_user;
    //echo 'La référence est : '.$ref;

    //on vérifie qu'elle n'existe pas déjà
    $verif = Emprunt::get($ref);
    $i = 0;
    $newRef = $ref;
    //var_dump($verif);

    //si elle existe
   while($verif !== 0){
      $newRef = $ref.$i;
      //echo "bim".$newRef;
      $verif = Emprunt::get($newRef);
      //var_dump($verif);
      //echo $i;
      $i=$i+1;
    }

    //echo '</br>La nouvelle référence est : '.$newRef;
    $this->ref_emprunt=$newRef;
   }

}