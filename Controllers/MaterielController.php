<?php

include("/Models/User.php");

class MaterielController
{
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
		$listEmprunt = Emprunt::getByMateriel($this->ref_objet);
    	require_once('Views/materiel/showMateriel.php');
	}

	public function delete(){
		if($_SESSION['statut']=='1'){
			echo "Vous n'êtes pas autorisé à faire cette action";
		} 
		else {
			$db = Db::getInstance();
			$sql = "DELETE FROM materiels
					WHERE ref_objet = '".$this->ref_objet."'";
	    	$sth = $db->prepare($sql);
	    	$sth->execute();
		}
		
	}

	public function add(){
		if($_SESSION['statut']=='1'){
			echo "Vous n'êtes pas autorisé à faire cette action";
		} 
		else {
			require_once('Views/materiel/addMateriel.php');
		}
	}

	public function addSave(){
		if($_SESSION['statut']=='1'){
			echo "Vous n'êtes pas autorisé à faire cette action";
		} 
		else {
			$db = Db::getInstance();
			//echo "blblblblbl".$_POST['ref_objet']."</br>";
			$materiel = new Materiel();
			$materiel->hydrate( $_POST );
			$sql = "INSERT INTO materiels VALUES ".$materiel->getProperties();
	    	$sth = $db->prepare($sql);
	    	$sth->execute();
		}
		
	}

	public function edit(){
		if($_SESSION['statut']=='1'){
			echo "Vous n'êtes pas autorisé à faire cette action";
		} 
		else{
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
	}

	public function editSave(){
		if($_SESSION['statut']=='1'){
			echo "Vous n'êtes pas autorisé à faire cette action";
		} 
		else {
			echo $this->ref_objet;
			$db = Db::getInstance();
			$materiel = new Materiel();
			$materiel->hydrate( $_POST );
			$sql = "UPDATE materiels
					SET ref_objet = '".$materiel->ref_objet."',
						nom_objet = '".$materiel->nom_objet."',
						id_type = ".$materiel->id_type.", 
						description = '".addslashes($materiel->description)."',
						etat = '".addslashes($materiel->etat)."' 
						WHERE ref_objet = '".$this->ref_objet."'";
			echo $sql;
		    $sth = $db->prepare($sql);
		    $sth->execute();
		}
	}


}