<?php


class UserController
{

	//toutes les fonctions type getstatut, add, addsave, edit, editsave, delete, liste, connexion, deconnexion

	public $id_user;

	//afficher le profil de l'utilisateur connecté
	public function index(){
		require_once('Views/user/profilUser.php');
	}

	
	//afficher tous les utilisateurs pour les admins et respos matos
	public function showAll(){
		if($_SESSION['statut'] == '1'){
			echo "Vous n'êtes pas autorisé à accéder à cette page";
		}
		else{
			$list = User::getList();
			foreach ($list as $user) {
				echo "<p> Nom Prénom : ".$user->nom." ".$user->prenom."</p>";
			}
		}
	}


	//supprimer un utilisateur
	public function delete(){
		$db = Db::getInstance();

		//on vérifie que celui qui veut supprimer est bien l'utilisateur ou un admin
		$verif = User::verifUser($this->id_user);
		if($verif == 1){
			$sql = "DELETE FROM users
				WHERE id_user = ".$this->id_user;
	    	$sth = $db->prepare($sql);
	    	$sth->execute();
		}
		else{
			echo "Vous n'avez pas le droit de supprimer cet utilisateur";
		}
		header('Location: /803Z');
	}


	//inscription d'un nouvel utilisateur
	public function add(){
		//view
		require_once('Views/user/addUser.php');
	}


	//sauvegarde de l'inscription
	public function addSave(){
		$db = Db::getInstance();
		$user = new User();
		$user->hydrate( $_POST );
		$sql = "INSERT INTO users (nom, prenom, id_filiere, date_naissance, adresse, mail, password, telephone) VALUES ".$user->getProperties();
		//echo $sql;
	    $sth = $db->prepare($sql);
	    $sth->execute();
	    //redirection
	    header('Location: /803Z');
	}


	//modifier son profil
	public function edit(){
		//echo $this->id_user;
		//on vérifie l'identité de l'utilisateur
		$verif = User::verifUser($this->id_user);
		if($verif == 1){
			$db = Db::getInstance();
			$user = new user( $id_user );
			$sql = "SELECT * FROM users WHERE id_user = '".$this->id_user."'";
	    	$sth = $db->prepare( $sql );
	    	$sth->execute();
	    	$user->hydrate($sth->fetch( \PDO::FETCH_ASSOC));
	    	echo $user->getProperties();
	    	//view
	    	require_once('Views/user/editUser.php');
	    }
	    else{
	    	echo "Vous n'avez pas le droit de modifier cet utilisateur";
	    }

	}


	//sauvegarder les modifications
	public function editSave(){
		//echo $this->id_user;
		$db = Db::getInstance();
		$user = new User();
		$user->hydrate( $_POST );
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
		//echo $sql;
	    $sth = $db->prepare($sql);
	    $sth->execute();
	    //redirection
	    header('Location: /803Z');
	}

	//connexion 
	public function connexion(){
		//view
		require_once('Views/user/connexion.php');
	}


	//lancer une session et récupérer les données de l'utilisateur pendant la session de connexion
	public function sessionStart()
 	{
	 	$mail=$_POST['mail'];
	 	$password=$_POST['password'];
	 	$getByMail = User::getByMail($mail, $password);
	 	$statut = $getByMail['id_statut'];
	 	$id = $getByMail['id_user'];
	 	$nom = $getByMail['nom'];
	 	$prenom = $getByMail['prenom'];
	 	//var_dump($statut);
	 	//recuperer le statut
	 	//$id_statut = User::getStatut();
	 	
	 	$_SESSION['User'] = array(
	    	"mail"=>$mail,
	    	"password"=>$password,
	    	"statut"=>$statut,
	    	"id"=>$id,
	    	"nom" => $nom,
	    	"prenom" => $prenom
		);

		if(User::isLogged()){
			//echo 'Vous êtes connecté';
		    $_SESSION['connecte']=true;
		    $_SESSION['mail']=$mail;
		    $_SESSION['statut']= $statut;
		    $_SESSION['id']= $id;
		    //redirection
		     //header('Location: http://perso-etudiant.u-pem.fr/~mrosenbe/803Z/');
		     header('Location: /803Z');
		}
		else {
			//redirection
			//header('Location: http://perso-etudiant.u-pem.fr/~mrosenbe/803Z/');
			header('Location: /803Z');
		}


}

	public function deconnexion() {
		//déconnecter et rediriger
	  session_destroy();
	  //header('Location: http://perso-etudiant.u-pem.fr/~mrosenbe/803Z');
	  header('Location: /803Z');
	}

}