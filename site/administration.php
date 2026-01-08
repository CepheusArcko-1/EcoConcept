<?php
session_start();

if ((!(isset($_SESSION['id'])) || empty($_SESSION['id'])) && $_SESSION['role'] != "admin") {
	header("Location:connexion.php");
}
?>
<!DOCTYPE html>

<html lang="fr">
<head>
	<title>TEST GREEN IT</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="content/administration.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
<!--*************** MENU ***************-->
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="./images/scierie.gif" alt="Logo" width="50">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="produits.php">Produits</a></li>
            <li class="nav-item"><a class="nav-link" href="video.php">Vidéo</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>

            <?php if (isset($_SESSION['id'])): ?>
                <li class="nav-item"><a class="nav-link" href="administration.php">Administration</a></li>
                <li class="nav-item"><a class="nav-link" href="deconnexion.php">Déconnexion</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="connexion.php">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$('.menu').click(function(){
			$('#mainNav .navbar-nav').toggleClass('active');
		})
	})
</script>
<!--*************** END MENU ***************-->
	<!-- Ajout d'un produit -->
	<div class="row">
	<div class="containerAjoutProduit col-90">
		<h1> Ajout d'un nouveau produit</h1>
		<span class="reussite"> 
			<?php
				if (isset($_SESSION['msgAddOk'])) {
					echo $_SESSION['msgAddOk'];
					$_SESSION['msgAddOk'] = "";
				}
			
			?>
		</span>	
		<span class="err"> 
			<?php
				if (isset($_SESSION['msgAddNok'])) {
					echo $_SESSION['msgAddNok'];
					$_SESSION['msgAddNok'] = "";
				}
			
			?>
		</span>
		<form  id="formAjoutProduit" action="" method="post">
			<div class="row">
				<div class="col-40">
					<label for="lbProduit">Titre du produit</label>
				</div>
				<div class="col-40">
					<input type="text" id="lbProduit" name="lbProduit" placeholder="Entrer le titre du produit" required/>
				</div>
			</div>
			<div class="row">
				<div class="col-40">
					<label for="lbDescr">Description</label>
				</div>
				<div class="col-40" id="description">
					<input type="text" id="lbDescr" name="lbDescr" placeholder="Entrer la description" required/>
				</div>
			</div>
			<div class="row">
				<div class="col-40">
					<label for="lbImg">Image</label>
				</div>
				<div class="col-40" id="image">
					<input type="text" id="lbImg" name="lbImg" placeholder="Entrer le nom d'une image" required/>
				</div>
			</div>

			<div class="row">
				<input id="btnAjoutProduit" type="button" value="Ajouter">
			</div>
		</form>
	</div>

	
	
	
	<!-- Modification de produit -->
	<div class="containerModifProduit col-90">
		<h1> Modification d'un produit</h1>
		<span class="reussite"> 
			<?php
				if (isset($_SESSION['msgModifOk'])) {
					echo $_SESSION['msgModifOk'];
					$_SESSION['msgModifOk'] = "";
				}
			
			?>
		</span>	
		<span class="err"> 
			<?php
				if (isset($_SESSION['msgModifNok'])) {
					echo $_SESSION['msgModifNok'];
					$_SESSION['msgModifNok'] = "";
				}
			
			?>
        </span>			
			<form  id="formModifproduit" action="#" method="post">
				<div class="row" id="rowModificationProduit">
				</div>	
				<div class="row">
					<div class="col-40">
						<label for="lbDescrModif">Description</label>
					</div>
					<div class="col-40" id="descriptionModif">
						<input type="text" id="lbDescrModif" name="lbDescrModif" placeholder="Entrer la description" required/>
					</div>
				</div>
				<div class="row">
					<div class="col-40">
						<label for="lbImgModif">Image</label>
					</div>
					<div class="col-40" id="imageModif">
						<input type="text" id="lbImgModif" name="lbImgModif" placeholder="Entrer le nom d'une image" required/>
					</div>
				</div>
				<div class="row">
					<input id="btnModifProduit" type="button" value="Modifier">
				</div>
			
			</form>
	</div>
	</div>
	<!-- Suppression de produit -->
	<div class="row">
	<div class="containerSuppProduit col-90">
		<h1> Suppression d'un produit</h1>
		<span class="reussite"> 
			<?php
				if (isset($_SESSION['msgSuppOk'])) {
					echo $_SESSION['msgSuppOk'];
					$_SESSION['msgSuppOk'] = "";
				}
			
			?>
        </span>	
		<span class="err"> 
			<?php
				if (isset($_SESSION['msgSuppNok'])) {
					echo $_SESSION['msgSuppNok'];
					$_SESSION['msgSuppNok'] = "";
				}
			
			?>
        </span>			
			<form  id="formSuppProduit" action="#" method="post">
				<div class="row" id="rowSuppression">
				</div>
				<div class="row">
				<input id="btnSuppProduit" type="button" value="Supprimer">
			</div>
		    </form>
	</div>
<!--*************** PIED DE PAGE ***************-->
<footer class="bg-light py-3 mt-5">
    <ul class="d-flex justify-content-center align-items-center list-unstyled mb-0">
        <li class="mx-3">© Projet 3iL</li>
        <li class="mx-3">
            <a href="#"><img src="images/facebook.png" alt="Facebook" width="24"></a>
        </li>
        <li class="mx-3">Site test</li>
    </ul>
</footer>
<!--*************** PIED DE PAGE ***************-->
	
	<script src="scripts/initSelectModifProduit.js"></script>
	<script src="scripts/initSelectModifAccueil.js"></script>
	<script src="scripts/initSelectSuprProduit.js"></script>
</body>

</html>