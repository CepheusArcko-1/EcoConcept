<?php

	/* Connexion à la bdd */
	$con = mysqli_connect("localhost", "root", "", "scierie");

	/* Gestion des erreurs de connexion */
	if (mysqli_connect_errno($con)){
		echo "Erreur de connexion: " . mysqli_connect_error();
	}

	mysqli_set_charset($con,"utf8");

	$desc = isset($_POST["areaModifAccueil"]) ? trim($_POST["areaModifAccueil"]) : "";

	$req = "UPDATE home SET `desc` = ? WHERE id = 1";
	$stmt = mysqli_prepare($con, $req);

	/* Gestion des erreurs de préparation */
	if (!$stmt){
		echo "Echec prepare: " . mysqli_error($con);
		mysqli_close($con);
		exit;
	}

	mysqli_stmt_bind_param($stmt, "s", $desc);

	/* Gestion des erreurs d'exécution */
	if (!mysqli_stmt_execute($stmt)){
		echo "Echec de l'update" . mysqli_stmt_error($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($con);
		exit;
	}

	mysqli_stmt_close($stmt);
	
	/* Déconnexion de la bdd */
	mysqli_close($con);
	header('Location: ../index.php'); 

?>