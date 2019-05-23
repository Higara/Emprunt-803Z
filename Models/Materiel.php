<?php

//namespace Models;

class Materiel
{
	 protected $allowed_properties = [ 'ref_objet', 'nom_objet', 'id_type', 'description', 'etat' ];
   protected $property = [];
	 protected $pk_name = 'ref_objet';

  public $ref_objet;
  public $nom_objet;
  public $id_type;
  public $description;
  public $etat;

	public static function get( $ref_objet ) {
    $matos = new Materiel();
    $db = Db::getInstance();
    $sql = "SELECT * FROM materiels WHERE ref_objet = '".$ref_objet."'";
    $sth = $db->prepare($sql);
    $sth->execute();
    $matos->hydrate($sth->fetch());
    return $matos;
  }


///////////////////////////////////////////////////////////////////////
//////////////////// A PARTIR D'ICI CA MARCHE ///////////////////////////////////
   public static function getList() {
    $list = [];
    //on ouvre l'accès à la bdd
    $db = Db::getInstance();
    $sql = 'SELECT * FROM materiels';
    $sth = $db->prepare($sql);
    $sth->execute();

    // Recuperer une liste d'objet Materiel
    foreach($sth->fetchAll() as $matos) {
      $curr = new Materiel();
      $curr->hydrate($matos);
      $list[] = $curr;
    }

    return $list;
   }


  public function hydrate(array $data)
  {
    //remplis les propriétés de l'objet avec un array, comme un $_POST 
     foreach($data as $property => $value){
       $this->$property = $value;
     }
  }

   public function getProperties(){
    //permet de retourner les propriétés sous forme d'un string pour injection directe dans le sql
      $prop="('".$this->ref_objet."','".$this->nom_objet."', ".$this->id_type.",'".addslashes($this->description)."','".addslashes($this->etat)."')";
      echo $prop;
      return $prop;
   }
}