<?php

/*use projet;
use Models\Emprunt;*/
//use Models\User;
include("/Models/User.php");
//use

class ProjetController
{
	//toutes les fonctions index, show etc et pour les admins delete, add, addsave, edit, editsave
	public $id_projet;

	public function index(){
		$list = Projet::getByUser($_SESSION['id']);
		if($list !== 0){
			foreach ($list as $projet) {
				echo "<p> Description : ".$projet->description."</p>";
			}
		}
		
	}




	public function show(){
		echo $this->id_projet;
		$projet = Projet::get($this->id_projet);
    	require_once('Views/projet/showProjet.php');
	}




	public function showAll(){
		if($_SESSION['statut']=='1'){
			echo "Vous n'êtes pas autorisé à faire cette action";
		} 
		else {
			$list = Projet::getList();
			foreach ($list as $projet) {
				echo "<p> Description : ".$projet->description."</p>";
			}
		}
	}




	public function delete(){
		$verif = Projet::verifUser($this->id_projet);
		if($verif == 1){
			$db = Db::getInstance();
			$sql = "DELETE FROM projets
					WHERE id_projet = '".$this->id_projet."'";
		    $sth = $db->prepare($sql);
		    $sth->execute();
		}
		else{
			echo "Vous n'avez pas le droit de supprimer ce projet";
		}
	}



	public function add(){
		require_once('Views/projet/addProjet.php');
	}




	public function addSave(){
		$db = Db::getInstance();
		//echo "blblblblbl".$_POST['id_projet']."</br>";
		$projet = new Projet();
		$projet->hydrate( $_POST );
		$sql = "INSERT INTO projets (id_user, nom, description) VALUES ".$projet->getProperties();
	    $sth = $db->prepare($sql);
	    $sth->execute();
	}




	public function edit(){
		$verif = Projet::verifUser($this->id_projet);
		if($verif == 1){
			echo $this->id_projet;
			$db = Db::getInstance();
			$projet = new Projet( $id_projet );
			$sql = "SELECT * FROM projets WHERE id_projet = '".$this->id_projet."'";
	    	$sth = $db->prepare( $sql );
	    	$sth->execute();
	    	$projet->hydrate($sth->fetch( \PDO::FETCH_ASSOC));
	    	//echo $projet->getProperties();
	    	require_once('Views/projet/editProjet.php');
	    } 
	    else {
	    	echo "Vous n'avez pas le droit de modifier ce projet";
	    }
	}




	public function editSave(){
		$verif = Projet::verifUser($this->id_projet);
		if($verif == 1){
			echo $this->id_projet;
			$db = Db::getInstance();
			$projet = new Projet();
			$projet->hydrate( $_POST );
			$sql = "UPDATE projets
					SET nom = '".addslashes($projet->nom)."',
						description = '".addslashes($projet->description)."'  
						WHERE id_projet = ".$this->id_projet;
			echo $sql;
		    $sth = $db->prepare($sql);
		    $sth->execute();
		}
		else {
	    	echo "Vous n'avez pas le droit de modifier ce projet";
	    }
	}

	public function addParticipant(){
		$verif = Projet::verifUser($this->id_projet);
		if($verif == 1){
			$projet = new Projet( $id_projet );
			$listUser = User::getList();
			require_once('Views/projet/addParticipant.php');
		}
		else {
			echo "Vous ne pouvez pas modifier ce projet";
		}
	}

	public function addSaveParticipant(){
		echo $_POST['id_projet'];
		$verif = Projet::verifUser($_POST['id_projet']);
		if($verif == 1){
			$db = Db::getInstance();
			$sql = "INSERT INTO participants (id_projet, id_user) VALUES (".$_POST['id_projet'].", ".$_POST['id_user'].")";
			echo $sql;
		    $sth = $db->prepare($sql);
		    $sth->execute();
	    }
		else {
			echo "Vous ne pouvez pas modifier ce projet";
		}
	}

}