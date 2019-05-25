<?php

include("/Models/User.php");
include("/Models/Emprunt.php");


class ProjetController
{
	//toutes les fonctions index, show, delete, add, addsave, edit, editsave
	public $id_projet;

	//liste des projets d'un utilisateur
	public function index(){
		$list = Projet::getByUser($_SESSION['id']);
		//on appelle la view
		require_once('Views/projet/indexProjets.php');
	}



	//voir les détails d'un objet
	public function show(){
		//echo $this->id_projet;
		$projet = Projet::get($this->id_projet);
		$listParticipants = Projet::getParticipants($this->id_projet);
		$listEmprunts = Emprunt::getByProjet($this->id_projet);
		//on appelle la view
    	require_once('Views/projet/showProjet.php');
	}



	//liste de la totalité des projets, inaccessible pour les utilisateurs simples
	public function showAll(){
		if($_SESSION['statut']=='1'){
			echo "Vous n'êtes pas autorisé à faire cette action";
		} 
		else {
			$list = Projet::getList();
			foreach ($list as $projet) {
				echo "<p> Description : ".$projet->description."</p>";
			}
			//on appelle la view
			require_once('Views/projet/indexProjets.php');
		}
	}



	//supprimer un projet
	public function delete(){
		//on vérifie que l'utilisateur qui veut supprimer le projet est bien son créateur OU un admin
		$verif = Projet::verifUser($this->id_projet);
		if($verif == 1){
			$db = Db::getInstance();
			$sql = "DELETE FROM projets
					WHERE id_projet = '".$this->id_projet."'";
		    $sth = $db->prepare($sql);
		    $sth->execute();
		    //redirection
		    header('Location: /803Z?controller=Projet&action=index');
		}
		else{
			echo "Vous n'avez pas le droit de supprimer ce projet";
		}
	}


	//ajouter un projet
	public function add(){
		//ne fait qu'appeler la view
		require_once('Views/projet/addProjet.php');
	}



	//sauvegarder l'ajout du projet
	public function addSave(){
		$db = Db::getInstance();
		$projet = new Projet();
		$projet->hydrate( $_POST );
		$sql = "INSERT INTO projets (id_user, nom, description) VALUES ".$projet->getProperties();
	    $sth = $db->prepare($sql);
	    $sth->execute();
	    //redirection
	    header('Location: /803Z?controller=Projet&action=show&id='.$_POST['id_projet']);
	}



	//modifier un projet existant
	public function edit(){
		//on vérifie que l'utilisateur qui veut modifier le projet est bien son créateur OU un admin
		$verif = Projet::verifUser($this->id_projet);
		if($verif == 1){
			//echo $this->id_projet;
			//on récupère les valeurs existantes, pour les afficher dans le formulaire de modification
			$db = Db::getInstance();
			$projet = new Projet( $id_projet );
			$sql = "SELECT * FROM projets WHERE id_projet = '".$this->id_projet."'";
	    	$sth = $db->prepare( $sql );
	    	$sth->execute();
	    	$projet->hydrate($sth->fetch( \PDO::FETCH_ASSOC));
	    	//on appelle la view
	    	require_once('Views/projet/editProjet.php');
	    } 
	    else {
	    	echo "Vous n'avez pas le droit de modifier ce projet";
	    }
	}



	//enregistrer les modifications
	public function editSave(){
		//on vérifie que l'utilisateur qui veut modifier le projet est bien son créateur OU un admin
		//Oui je vérifie ça beaucoup trop souvent mais vaut mieux être trop prudent
		$verif = Projet::verifUser($this->id_projet);
		if($verif == 1){
			//echo $this->id_projet;
			$db = Db::getInstance();
			$projet = new Projet();
			$projet->hydrate( $_POST );
			$sql = "UPDATE projets
					SET nom = '".addslashes($projet->nom)."',
						description = '".addslashes($projet->description)."'  
						WHERE id_projet = ".$this->id_projet;
			//echo $sql;
		    $sth = $db->prepare($sql);
		    $sth->execute();
		    //redirection
		    header('Location: /803Z?controller=Projet&action=show&id='.$_POST['id_projet']);
		}
		else {
	    	echo "Vous n'avez pas le droit de modifier ce projet";
	    }
	}


	//ajouter un participant au projet
	public function addParticipant(){
		//on vérifie que l'utilisateur qui veut ajouter un participant à un projet est bien son créateur OU un admin
		$verif = Projet::verifUser($this->id_projet);
		if($verif == 1){
			$projet = new Projet( $id_projet );
			$listUser = User::getList();
			//on appelle la view
			require_once('Views/projet/addParticipant.php');
		}
		else {
			echo "Vous ne pouvez pas modifier ce projet";
		}
	}

	//sauvegarder le participant 
	public function addSaveParticipant(){
		//echo $_POST['id_projet'];
		$verif = Projet::verifUser($_POST['id_projet']);
		if($verif == 1){
			$db = Db::getInstance();
			$sql = "INSERT INTO participants (id_projet, id_user) VALUES (".$_POST['id_projet'].", ".$_POST['id_user'].")";
			echo $sql;
		    $sth = $db->prepare($sql);
		    $sth->execute();
		    //redirection
		    header('Location: /803Z?controller=Projet&action=show&id='.$_POST['id_projet']);
	    }
		else {
			echo "Vous ne pouvez pas modifier ce projet";
		}
	}

	//NOTE : pouvoir supprimer un participant

}