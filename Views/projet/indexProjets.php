<div id="shadow-container">
         
        <h1>Bienvenue <?php echo $_SESSION['User']['nom']." ".$_SESSION['User']['prenom']; ?></h1>

        <h2> Liste des projets </h2>

             <?php if($list !== 0){
            foreach ($list as $projet) {
                echo "<div> Description et id : ".$projet->description." ".$projet->id_projet."</div>";
            }
        }
        else {
            echo "<div> Vous n'avez aucun projet </div>";
        }

        ?>


        <button class="fill"><a href="?controller=Projet&action=add">Nouveau projet</a></button>

</div>

