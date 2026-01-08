<?php

	/* Connexion à la bdd */
	$con = mysqli_connect("localhost", "root", "", "scierie");

	/* Gestion des erreurs de connexion */
	if (mysqli_connect_errno()){
		echo "Erreur de connexion: " . mysqli_connect_error();
	}

	mysqli_set_charset($con,"utf8");

	/* Requête SQL */
	$sql = "SELECT home.titre, home.descr, home.img FROM home";

	/* Gestion des erreurs de requête sql */
	if (!mysqli_query($con, $sql)){
		echo "Création échouée" . mysqli_error($con);
	}

	$requete = $con->query($sql);

	while ($resultat = mysqli_fetch_array($requete))
    {
		$description = "<ul class='main-list'>";

		$titre_safe = htmlspecialchars($resultat['titre'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
		$descr_safe = htmlspecialchars($resultat['descr'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

		$img_safe = basename($resultat['img']);
		$img_ok = preg_match('/^[a-zA-Z0-9._-]+\.(jpg|jpeg|png|gif|webp|svg)$/i', $img_safe);

		if($resultat['titre']!='') {
			$description .= "<li class='main-item'><p class='titre'>".$titre_safe."</p></li>";
		}
		if($resultat['descr']!='' && $resultat['img']!='' && $img_ok){
			$description .= "<li class ='main-item'><ul class ='sub-list'>";

			$description .= "<li class='sub-item'><p class='texte'>".$descr_safe."</p></li>";

			$description .= "<li class='sub-item'><img class='image' src='images/".htmlspecialchars($img_safe, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')."'></li>";
			
			$description .= "</ul></li>";
		
		}else{
			if($resultat['descr']!=''){
				$description .= "<li class='main-item'><p class='texte'>".$descr_safe."</p></li>";
			}
			if($resultat['img']!='' && $img_ok){
				$description .= "<li class='main-item'><img class='image' src='images/".htmlspecialchars($img_safe, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')."'></li>";
			}
		}
		$description .="</ul>";
        echo $description;

	}

	mysqli_close($con)
?>