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
		$list = Projet::getList();
		foreach ($list as $projet) {
			echo "<p> Description : ".$projet->description."</p>";
		}
	}

	public function delete(){
		$db = Db::getInstance();
		$sql = "DELETE FROM projets
				WHERE id_projet = '".$this->id_projet."'";
	    $sth = $db->prepare($sql);
	    $sth->execute();
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
		echo $this->id_projet;
		$db = Db::getInstance();
		$projet = new Projet( $id_projet );
		$sql = "SELECT * FROM projets WHERE id_projet = '".$this->id_projet."'";
    	$sth = $db->prepare( $sql );
    	$sth->execute();
    	$projet->hydrate($sth->fetch( \PDO::FETCH_ASSOC));
    	echo $projet->getProperties();
    	require_once('Views/projet/editProjet.php');
	}

	public function editSave(){
		echo $this->id_projet;
		$db = Db::getInstance();
		$projet = new Projet();
		$projet->hydrate( $_POST );
		$sql = "UPDATE projets
				SET nom = '".$projet->nom."',
					description = '".$projet->description."'  
					WHERE id_projet = ".$this->id_projet;
		echo $sql;
	    $sth = $db->prepare($sql);
	    $sth->execute();
	}


}