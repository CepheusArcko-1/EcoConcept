<?php
session_start();
?>
<!DOCTYPE html>

<html lang="fr">

<head>
	<title>TEST GREEN IT</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>

	<section>
<!--*************** MENU ***************-->
<nav class="navbar">
	<button class="toggle toggle-item" id="menuToggle" aria-controls="navLinks" aria-expanded="false" aria-label="Ouvrir le menu">
		<i class="fa fa-bars" aria-hidden="true"></i>
	</button>
   <ul class="nav-links" id="navLinks">
      	<li class="nav-item"><a href="index.php">ACCUEIL</a></li>
      	<li class="nav-item"><a href="produits.php">LES PRODUITS</a></li>
	  	<li class="nav-item"><a href="video.php">VIDEO</a></li>
		<li class="nav-item"><a href="contact.php">NOUS CONTACTER</a></li>
<?php 
	if (isset($_SESSION['id'])) {	
		echo "<li class='nav-item'><a href='administration.php'>ADMINISTRATION</a></li>";
	}
	if(isset($_SESSION['id'])) {
		echo "<li class='nav-item'><a href='deconnexion.php'>DECONNEXION</a></li>";
	}else{
		echo "<li class='nav-item'><a href='connexion.php'>CONNEXION</a></li>";
	}
?>
    </ul>

	<img src="./images/scierie.gif" style="width:70px; margin:5px;">
</nav>

<!--*************** END MENU ***************-->
	</section>

	<main class="container" style="max-width:480px;margin:18px auto;">
		<form action="controleur/traitementFormConnexion.php" method="GET" id="login">
			<h1>Connexion</h1>
			<span class="err">
				<?php
					if (isset($_SESSION['errCnx'])) {
						echo $_SESSION['errCnx'];
						$_SESSION['errCnx'] = "";
					}
                    
					if (isset($_SESSION['creationOk'])) {
						echo $_SESSION['creationOk'];
						$_SESSION['creationOk'] = "";
					}
                    
					if (isset($_SESSION['creationNok'])) {
						echo $_SESSION['creationNok'];
						$_SESSION['creationNok'] = "";
					}
				?>
			</span>
			<div class="input-field">
				<label for="idUtil">Identifiant</label>
				<input type="text" placeholder="Entrer le nom d'utilisateur" name="idUtil" id="idUtil" required autocomplete="username">

				<label for="mdpUtil">Mot de Passe</label>
				<input type="password" placeholder="Entrer le mot de passe" name="mdpUtil" id="mdpUtil" required autocomplete="current-password">

				<div style="margin-top:12px;">
					<input type="submit" value="Se connecter" class="button">
				</div>
			</div>
		</form>
	</main>

<!--*************** PIED DE PAGE ***************-->
<footer id="footer">
<ul class="footer-links">
    <li class="footer-item">©Projet 3iL</li>
    <li class="footer-item"><a href="#" target="_blank"><img id="logo" src="images/facebook.png"></a></li>
    <li class="footer-item">Site test</li>
<ul/>
</footer>
<!--*************** PIED DE PAGE ***************-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
	(function($){
		$(function(){
			var $menuToggle = $('#menuToggle');
			var $navLinks = $('#navLinks');
			$menuToggle.on('click', function(){
				var expanded = $(this).attr('aria-expanded') === 'true';
				$(this).attr('aria-expanded', String(!expanded));
				$navLinks.toggleClass('active');
			});
		});
	})(jQuery);
	</script>

</body>

</html>




