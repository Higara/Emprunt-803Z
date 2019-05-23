<?php

include("/Models/Materiel.php");
include("/Models/User.php");

class EmpruntController
{
	//toutes les fonctions index, delete, add, addsave, edit, editsave

	public $ref_emprunt;


	public function index(){
		$list = Emprunt::getByUser($_SESSION['id']);
		foreach ($list as $emprunt) {
			echo "<p> Ref : ".$emprunt->ref_emprunt."</p>";
		}
	}

	public function showAll(){
		if($_SESSION['statut'] == '1'){
      		echo "Vous n'êtes pas autorisé à accéder à cette page";
      		return 0;
    	}
		$list = Emprunt::getList();
		foreach ($list as $emprunt) {
			echo "<p> Description : ".$emprunt->ref_emprunt."</p>";
		}
	}

	public function show(){
		echo $this->ref_emprunt;
		$emprunt = Emprunt::get($this->ref_emprunt);
    	require_once('Views/emprunt/showEmprunt.php');
	}

	public function delete(){
		$db = Db::getInstance();
		$verifUser = Emprunt::verifUser($this->ref_emprunt);
		if($verifUser == 1){
			$sql = "DELETE FROM emprunts
				WHERE ref_emprunt = '".$this->ref_emprunt."'";
	    	$sth = $db->prepare($sql);
	    	$sth->execute();
		}
		else {
			echo "Vous n'avez pas les droits sur cet emprunt</br>";
		}
		
	}

	public function add(){
		$listMatos = Materiel::getList();
		$listUser = User::getList();
		require_once('Views/emprunt/addEmprunt.php');
	}

	public function addSave(){
		$db = Db::getInstance();
		$emprunt = new Emprunt();
		$emprunt->hydrate( $_POST );
		$emprunt->setRef();
		$dispo = Emprunt::verifDispo($emprunt->ref_objet, $emprunt->date_debut, $emprunt->date_fin);
		if($dispo == 1){
			$sql = "INSERT INTO emprunts VALUES ".$emprunt->getProperties();
	    	$sth = $db->prepare($sql);
	    	$sth->execute();
		}
		else {
			echo "Veuillez recommencer l'emprunt</br>";
			return 0;
		}
		
	}

	public function edit(){
		$listMatos = Materiel::getList();
		$listUser = User::getList();
		echo $this->ref_emprunt;
		$db = Db::getInstance();
		$emprunt = new Emprunt( $ref_emprunt );
		$sql = "SELECT * FROM emprunts WHERE ref_emprunt = '".$this->ref_emprunt."'";
    	$sth = $db->prepare( $sql );
    	$sth->execute();
    	$emprunt->hydrate($sth->fetch( \PDO::FETCH_ASSOC));
    	echo $emprunt->getProperties();
    	require_once('Views/emprunt/editEmprunt.php');
	}

	public function editSave(){
		echo $this->ref_emprunt;
		$db = Db::getInstance();
		$emprunt = new Emprunt();
		$emprunt->hydrate( $_POST );
		$sql = "UPDATE emprunts
				SET ref_emprunt = '".$emprunt->ref_emprunt."', 
					ref_objet = ".$emprunt->ref_objet.", 
					id_user =".$emprunt->id_user.", 
					date_debut = '".$emprunt->date_debut."', 
					date_fin = '".$emprunt->date_fin."', 
					id_projet = ".$emprunt->id_projet.", 
					remarques = '".addslashes($emprunt->remarques)."' 
					WHERE ref_emprunt = '".$this->ref_emprunt."'";
		echo $sql;
	    $sth = $db->prepare($sql);
	    $sth->execute();
	}
}