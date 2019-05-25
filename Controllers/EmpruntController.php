<?php

include("/Models/Materiel.php");
include("/Models/User.php");
include("/Models/Projet.php");

class EmpruntController
{
	//toutes les fonctions index, delete, add, addsave, edit, editsave

	public $ref_emprunt;

	//tous les emprunts d'un utilisateur
	public function index(){
		$list = Emprunt::getByUser($_SESSION['id']);
		foreach ($list as $emprunt) {
			echo "<p> Ref : ".$emprunt->ref_emprunt."</p>";
		}
	}

	//tous les emprunts pour les admins / respos matériel
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


	//infos sur un emprunt
	public function show(){
		echo $this->ref_emprunt;
		$emprunt = Emprunt::get($this->ref_emprunt);
		$projet = Projet::get($emprunt->id_projet);
    	require_once('Views/emprunt/showEmprunt.php');
	}


	//supprimer un emprunt
	//NOTE : on devrait vérifier la date de l'emprunt avant de supprimer
	public function delete(){
		$db = Db::getInstance();
		//on vérifie que bon utilisateur ou admin
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
		header('Location: /803Z');
		
	}


	//faire une demande d'emprunt
	public function add(){
		$listMatos = Materiel::getList();
		$listProjet = Projet::getByUser($_SESSION['id']);
		require_once('Views/emprunt/addEmprunt.php');
	}


	//sauvegarder la demande d'emprunt
	public function addSave(){
		$db = Db::getInstance();
		$emprunt = new Emprunt();
		$emprunt->hydrate( $_POST );

		//la référence est composée de la date de la demande d'emprunt, la référence de l'objet, l'id utilisateur et jusqu'à 999 chiffres pour garder une clef unique
		$emprunt->setRef();

		//on vérifie l'ordre des dates et les dates des emprunts déjà existants pour cet objet
		$dispo = Emprunt::verifDispo($emprunt->ref_objet, $emprunt->date_debut, $emprunt->date_fin);

		//si c'est disponible sur cette date
		if($dispo == 1){
			$sql = "INSERT INTO emprunts VALUES ".$emprunt->getProperties();
	    	$sth = $db->prepare($sql);
	    	$sth->execute();
	    	//redirection
	    	 header('Location: /803Z?controller=Emprunt&action=show&id='.$emprunt->ref_emprunt);
		}
		else {
			echo "Veuillez recommencer l'emprunt</br>";
			return 0;
		}
		
	}


	//modifier un emprunt existant
	public function edit(){
		$listMatos = Materiel::getList();
		$listUser = User::getList();
		//echo $this->ref_emprunt;
		$verifUser = Emprunt::verifUser($this->ref_emprunt);
		if($verifUser == 1){
			$db = Db::getInstance();
			$emprunt = new Emprunt( $ref_emprunt );
			$sql = "SELECT * FROM emprunts WHERE ref_emprunt = '".$this->ref_emprunt."'";
	    	$sth = $db->prepare( $sql );
	    	$sth->execute();
	    	$emprunt->hydrate($sth->fetch( \PDO::FETCH_ASSOC));
	    	//echo $emprunt->getProperties();
	    	require_once('Views/emprunt/editEmprunt.php');
	    	//NOTE : on devrait empêcher la modification d'un emprunt dont la date de début est déjà passée
	    }
	    else {
	    	echo "Vous ne pouvez pas modifier cet emprunt.</br>";
	    }
	}


	//sauvegarder la modification de l'emprunt
	public function editSave(){
		//echo $this->ref_emprunt;
		$db = Db::getInstance();
		$emprunt = new Emprunt();
		$emprunt->hydrate( $_POST );

		//la référence peut changer 
		$emprunt->setRef();

		//on vérifie la disponibilité de l'objet
		$dispo = Emprunt::verifDispo($emprunt->ref_objet, $emprunt->date_debut, $emprunt->date_fin);
		if($dispo == 1){
			$sql = "UPDATE emprunts
					SET ref_emprunt = '".$emprunt->ref_emprunt."', 
						ref_objet = ".$emprunt->ref_objet.", 
						id_user =".$emprunt->id_user.", 
						date_debut = '".$emprunt->date_debut."', 
						date_fin = '".$emprunt->date_fin."', 
						remarques = '".addslashes($emprunt->remarques)."' 
						WHERE ref_emprunt = '".$this->ref_emprunt."'";
			//echo $sql;
		    $sth = $db->prepare($sql);
		    $sth->execute();
		    //redirection
		    header('Location: /803Z?controller=Emprunt&action=show&id='.$emprunt->ref_emprunt);
		}
		else{
			echo "Veuillez recommencer l'emprunt</br>";
			return 0;
		}
	}
}