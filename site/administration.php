<?php
session_start();
if (!isset($_SESSION['id']) || empty($_SESSION['id']) || $_SESSION['id'] !== 'Admin') {
    header("Location: connexion.php");
    exit;
}
?>
<!DOCTYPE html>

<html lang="fr">
<head>
	<title>Scierie - Administration</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="content/administration.css">

	<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
	<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
	<link rel="preconnect" href="https://ajax.googleapis.com" crossorigin>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
<a class="sr-only sr-only-focusable" href="#contenu">Aller au contenu principal</a>

<!--*************** MENU ***************-->
<nav class="navbar navbar-expand-md navbar-light bg-light" aria-label="Menu principal">
    <a class="navbar-brand" href="index.php">
        <img src="./images/logo.webp" alt="Logo EcoConcept" width="50" height="50">
    </a>

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
				<li class="nav-item"><a class="nav-link" href="inscription.php">Inscription</a></li>
			<?php endif; ?>
        </ul>
    </div>
</nav>

<!--*************** END MENU ***************-->

<main id="contenu" class="container-fluid" tabindex="-1">
	<!-- Ajout d'un produit -->
	<div class="row">
	<div class="containerAjoutProduit col-90">
		<h1> Ajout d'un nouveau produit</h1>
		<span class="reussite" role="status" aria-live="polite"> 
			<?php
				if (isset($_SESSION['msgAddOk'])) {
					echo htmlspecialchars($_SESSION['msgAddOk'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
					$_SESSION['msgAddOk'] = "";
				}
			?>
		</span>	
		<span class="err" role="alert" aria-live="assertive"> 
			<?php
				if (isset($_SESSION['msgAddNok'])) {
					echo htmlspecialchars($_SESSION['msgAddNok'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
					$_SESSION['msgAddNok'] = "";
				}
			?>
		</span>
		<form id="formAjoutProduit" action="" method="post" novalidate>
			<div class="row">
				<div class="col-40">
					<label for="lbProduit">Titre du produit</label>
				</div>
				<div class="col-40">
					<input type="text" id="lbProduit" name="lbProduit" placeholder="Entrer le titre du produit" required aria-required="true" autocomplete="off" maxlength="120"/>
				</div>
			</div>
			<div class="row">
				<div class="col-40">
					<label for="lbDescr">Description</label>
				</div>
				<div class="col-40" id="description">
					<input type="text" id="lbDescr" name="lbDescr" placeholder="Entrer la description" required aria-required="true" autocomplete="off" maxlength="500"/>
				</div>
			</div>
			<div class="row">
				<div class="col-40">
					<label for="lbImg">Image</label>
				</div>
				<div class="col-40" id="image">
					<input type="text" id="lbImg" name="lbImg" placeholder="Entrer le nom d'une image" required aria-required="true" autocomplete="off" inputmode="text" maxlength="120"/>
				</div>
			</div>

			<div class="row">
				<input id="btnAjoutProduit" type="button" value="Ajouter" aria-label="Ajouter le produit">
			</div>
		</form>
	</div>

	<!-- Modification de produit -->
	<div class="containerModifProduit col-90">
		<h1> Modification d'un produit</h1>
		<span class="reussite" role="status" aria-live="polite"> 
			<?php
				if (isset($_SESSION['msgModifOk'])) {
					echo htmlspecialchars($_SESSION['msgModifOk'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
					$_SESSION['msgModifOk'] = "";
				}
			?>
		</span>	
		<span class="err" role="alert" aria-live="assertive"> 
			<?php
				if (isset($_SESSION['msgModifNok'])) {
					echo htmlspecialchars($_SESSION['msgModifNok'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
					$_SESSION['msgModifNok'] = "";
				}
			?>
        </span>			
			<form id="formModifproduit" action="#" method="post" novalidate>
				<div class="row" id="rowModificationProduit" aria-label="Sélection du produit à modifier">
				</div>	
				<div class="row">
					<div class="col-40">
						<label for="lbDescrModif">Description</label>
					</div>
					<div class="col-40" id="descriptionModif">
						<input type="text" id="lbDescrModif" name="lbDescrModif" placeholder="Entrer la description" required aria-required="true" autocomplete="off" maxlength="500"/>
					</div>
				</div>
				<div class="row">
					<div class="col-40">
						<label for="lbImgModif">Image</label>
					</div>
					<div class="col-40" id="imageModif">
						<input type="text" id="lbImgModif" name="lbImgModif" placeholder="Entrer le nom d'une image" required aria-required="true" autocomplete="off" inputmode="text" maxlength="120"/>
					</div>
				</div>
				<div class="row">
					<input id="btnModifProduit" type="button" value="Modifier" aria-label="Modifier le produit sélectionné">
				</div>
			
			</form>
	</div>
	</div>

	<!-- Suppression de produit -->
	<div class="row">
	<div class="containerSuppProduit col-90">
		<h1> Suppression d'un produit</h1>
		<span class="reussite" role="status" aria-live="polite"> 
			<?php
				if (isset($_SESSION['msgSuppOk'])) {
					echo htmlspecialchars($_SESSION['msgSuppOk'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
					$_SESSION['msgSuppOk'] = "";
				}
			?>
        </span>	
		<span class="err" role="alert" aria-live="assertive"> 
			<?php
				if (isset($_SESSION['msgSuppNok'])) {
					echo htmlspecialchars($_SESSION['msgSuppNok'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
					$_SESSION['msgSuppNok'] = "";
				}
			?>
        </span>			
			<form id="formSuppProduit" action="#" method="post" novalidate>
				<div class="row" id="rowSuppression" aria-label="Sélection du produit à supprimer">
				</div>
				<div class="row">
				<input id="btnSuppProduit" type="button" value="Supprimer" aria-label="Supprimer le produit sélectionné">
			</div>
		    </form>
	</div>
</main>

<!--*************** PIED DE PAGE ***************-->
<footer class="bg-light py-3 mt-5" role="contentinfo">
    <ul class="d-flex justify-content-center align-items-center list-unstyled mb-0">
        <li class="mx-3">© Projet 3iL</li>
        <li class="mx-3">
            <a href="#" aria-label="Facebook"><img src="images/facebook.webp" alt="Facebook" width="24" height="24" loading="lazy" decoding="async"></a>
        </li>
        <li class="mx-3">Site test</li>
    </ul>
</footer>
<!--*************** PIED DE PAGE ***************-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script type="text/javascript" defer>
	$(document).ready(function(){

		$('.menu').click(function(){
			$('#mainNav .navbar-nav').toggleClass('active');
		})
	})
</script>

<script src="scripts/initSelectModifProduit.js" defer></script>
<script src="scripts/initSelectModifAccueil.js" defer></script>
<script src="scripts/initSelectSuprProduit.js" defer></script>
</body>

</html>
