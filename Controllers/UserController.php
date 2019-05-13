<?php

/*namespace App\Controllers;
use App\Models\Materiel;
use App\Models\User;
use App\Models\Emprunt;
//use */

class UserController
{

	//toutes les fonctions type getstatut, add, addsave, edit, editsave, delete, liste, connexion, deconnexion + hachage du mot de passe ?

	public $id_user;

	public function index(){
		require_once('Views/user/profilUser.php');
	}

	

	public function liste(){
		$list = User::getList();
		foreach ($list as $user) {
			echo "<p> Prénom : ".$user->prenom."</p>";
		}
	}

	public function delete(){
		$db = Db::getInstance();
		$sql = "DELETE FROM users
				WHERE id_user = ".$this->id_user;
	    $sth = $db->prepare($sql);
	    $sth->execute();
	}

	public function add(){
		require_once('Views/user/addUser.php');
	}

	public function addSave(){
		$db = Db::getInstance();
		$user = new User();
		$user->hydrate( $_POST );
		$sql = "INSERT INTO users (nom, prenom, id_filiere, date_naissance, adresse, mail, password, telephone) VALUES ".$user->getProperties();
		echo $sql;
	    $sth = $db->prepare($sql);
	    $sth->execute();
	}

	public function edit(){
		echo $this->id_user;
		$db = Db::getInstance();
		$user = new user( $id_user );
		$sql = "SELECT * FROM users WHERE id_user = '".$this->id_user."'";
    	$sth = $db->prepare( $sql );
    	$sth->execute();
    	$user->hydrate($sth->fetch( \PDO::FETCH_ASSOC));
    	echo $user->getProperties();
    	require_once('Views/user/editUser.php');

	}

	public function editSave(){
		echo $this->id_user;
		$db = Db::getInstance();
		$user = new User();
		$user->hydrate( $_POST );
		//'id_user', 'nom', 'prenom', 'id_statut', 'id_filiere', 'date_naissance', 'adresse', 'mail', 'password', 'telephone', 'cotisation', 'photo'
		$sql = "UPDATE users
				SET nom = '".$user->nom."',
					prenom = '".$user->prenom."',
					id_filiere = ".$user->id_filiere.", 
					date_naissance = '".$user->date_naissance."', 
					adresse = '".$user->adresse."', 
					mail = '".$user->mail."',
					password = '".$user->password."',
					telephone = '".$user->telephone."' 
					WHERE id_user = '".$this->id_user."'";
		echo $sql;
	    $sth = $db->prepare($sql);
	    $sth->execute();
	}

	public function connexion(){
		require_once('Views/user/connexion.php');
	}

	public function sessionStart()
 	{
	 	$mail=$_POST['mail'];
	 	$password=$_POST['password'];
	 	$getStatut = User::getStatut($mail, $password);
	 	$statut = $getStatut['id_statut'];
	 	$getId = User::getId($mail, $password);
	 	$id = $getId['id_user'];
	 	//var_dump($statut);
	 	//recuperer le statut
	 	//$id_statut = User::getStatut();
	 	
	 	$_SESSION['User'] = array(
	    	"mail"=>$mail,
	    	"password"=>$password,
	    	"statut",
	    	"id"
		);

		if(User::isLogged()){
			echo 'Vous êtes connecté';
		    //session_start();
		    $_SESSION['connecte']=true;
		    $_SESSION['mail']=$mail;
		    $_SESSION['statut']= $statut;
		    $_SESSION['id']= $id;
		}
		else {
			echo 'Erreur :identifiant ou mot de passe incorrect';
		}

}

	public function deconnexion() {
	  //session_start();
	  session_destroy();
	  //redirect('');
	}

}