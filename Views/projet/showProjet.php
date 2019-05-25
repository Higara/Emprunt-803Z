<p>Voici les informations pour le projet <?php echo $projet->nom ?></p>

<p>Description : <?php echo $projet->description; ?></p>

<p>liste des participants : </p>

<?php

	foreach ($listParticipants as $participant) {
				echo "<p> Nom Prénom : ".$participant->nom." ".$participant->prenom."</p>";
			}
	?>

<p> Liste des emprunts pour ce projet : </p>

<?php

	foreach ($listEmprunts as $emprunt) {
				echo "<p> Matériel : ".$emprunt->ref_objet." du ".$emprunt->date_debut." au ".$emprunt->date_fin."</p>";
			}
	?>
