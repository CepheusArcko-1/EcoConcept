<?php
session_start();
require("../metier/DB_connector.php");
require("../metier/User.php");
require("../Dao/UserDao.php");

if (isset($_POST['idUtilCreation']) && isset($_POST['pwdCreation']) && isset($_POST['pwdBis'])) 
 {

    $cnx = new DB_Connector();
    $jeton = $cnx->openConnexion();

    $userManager = new UserDao($jeton);

	$id = trim($_POST['idUtilCreation']);
    $pwd = trim($_POST['pwdCreation']);
    $pwdBis = trim($_POST['pwdBis']);

    
	if (($userManager->idExist($id))) {
		 $_SESSION['errId'] = "Cette identifiant est déjà utilisé";	
		 $cnx->closeConnexion();
		 header('Location:../connexion.php');
	} else {
		if ($pwd != $pwdBis) {
			$_SESSION['errMdp'] = "Mot de passe non identique";	
			$cnx->closeConnexion();
			header('Location:../connexion.php');
			
		} else {
			$pwdHash = bcrypt($pwd);
			$newUser = new User([
				'userId' => $id,
				'userPwd' => $pwdHash
			]);
		
			if ($userManager->add($newUser)) {
				 $_SESSION['creationOk'] = "Nouvel utilisateur créé";
				 $cnx->closeConnexion();
				 header('Location:../connexion.php');
			} else {
				$_SESSION['creationNok'] = "Utilisateur non créé";
				$cnx->closeConnexion();
				header('Location:../connexion.php');
			}
		}
	
	}
}
?>