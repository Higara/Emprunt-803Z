<?php

/*use Materiel;
use Models\Emprunt;*/
//use Models\User;
include("/Models/User.php");
//use

class MaterielController
{
	//toutes les fonctions index, show etc et pour les admins delete, add, addsave, edit, editsave
	public $ref_objet;

	public function index(){
		$list = Materiel::getList();
		foreach ($list as $matos) {
			echo "<p> Description : ".$matos->description."</p>";
		}

	}

	public function show(){
		echo $this->ref_objet;
		$matos = Materiel::get($this->ref_objet);
    	require_once('Views/materiel/showMateriel.php');
	}

	public function delete(){
		$db = Db::getInstance();
		$sql = "DELETE FROM materiels
				WHERE ref_objet = '".$this->ref_objet."'";
	    $sth = $db->prepare($sql);
	    $sth->execute();
	}

	public function add(){
		require_once('Views/materiel/addMateriel.php');
	}

	public function addSave(){
		$db = Db::getInstance();
		//echo "blblblblbl".$_POST['ref_objet']."</br>";
		$materiel = new Materiel();
		$materiel->hydrate( $_POST );
		$sql = "INSERT INTO materiels VALUES ".$materiel->getProperties();
	    $sth = $db->prepare($sql);
	    $sth->execute();
	}

	public function edit(){
		echo $this->ref_objet;
		$db = Db::getInstance();
		$matos = new Materiel( $ref_objet );
		$sql = "SELECT * FROM materiels WHERE ref_objet = '".$this->ref_objet."'";
    	$sth = $db->prepare( $sql );
    	$sth->execute();
    	$matos->hydrate($sth->fetch( \PDO::FETCH_ASSOC));
    	echo $matos->getProperties();
    	require_once('Views/materiel/editMateriel.php');
	}

	public function editSave(){
		echo $this->ref_objet;
		$db = Db::getInstance();
		$materiel = new Materiel();
		$materiel->hydrate( $_POST );
		$sql = "UPDATE materiels
				SET ref_objet = '".$materiel->ref_objet."',
					nom_objet = '".$materiel->nom_objet."',
					id_type = ".$materiel->id_type.", 
					description = '".$materiel->description."',
					etat = '".$materiel->etat."' 
					WHERE ref_objet = '".$this->ref_objet."'";
		echo $sql;
	    $sth = $db->prepare($sql);
	    $sth->execute();
	}


}