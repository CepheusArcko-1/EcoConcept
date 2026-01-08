<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/User.php");
require("../Dao/UserDao.php");

// On récupère et test l'existance des variables de connexion
if (isset($_POST['idUtil']) || isset($_POST['mdpUtil'])) {

    // Accès à la BDD
    $cnx = new DB_Connector();
    $jeton = $cnx->openConnexion();

    $userManager = new UserDao($jeton);
    $userId = $_POST['idUtil'];
    $mdp = $_POST['mdpUtil'];
	
    $jetonExistance = $userManager->userExist($userId, MD5($mdp));
    if ($jetonExistance) {
      session_regenerate_id(true);//empeche vol de session
      $_SESSION['id'] = $userId;
         
		  $cnx->closeConnexion();
		  header('Location:../index.php');
    } else {
		  $_SESSION['errCnx'] = "La combinaison nom d'utilisateur/mot de passe est incorrecte"; 
		  $cnx->closeConnexion();
		  header('Location:../connexion.php');	
    }
}




?>