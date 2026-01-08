<?php
session_start();
?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <title>Scierie - Inscription</title>
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
                if (isset($_SESSION['id'])) {
                    echo "<li class='nav-item'><a href='deconnexion.php'>DECONNEXION</a></li>";
                } else {
                    echo "<li class='nav-item'><a href='connexion.php'>CONNEXION</a></li>";
                    echo "<li class='nav-item'><a href='inscription.php'>INSCRIPTION</a></li>";
                }
                ?>
            </ul>

            <img src="./images/logo.webp" style="width:70px; margin:5px;">
        </nav>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            (function($) {
                $(function() {
                    var $menuToggle = $('#menuToggle');
                    var $navLinks = $('#navLinks');
                    $menuToggle.on('click', function() {
                        var expanded = $(this).attr('aria-expanded') === 'true';
                        $(this).attr('aria-expanded', String(!expanded));
                        $navLinks.toggleClass('active');
                    });
                });
            })(jQuery);
        </script>
        <!--*************** END MENU ***************-->
    </section>

<main class="container" style="max-width:520px;margin:24px auto; padding:0 12px;">

    <div style="
        border:1px solid rgba(0,0,0,.12);
        border-radius:12px;
        padding:18px;
        background:#fff;
    ">
        <h1 style="font-size:2rem; line-height:1.2; margin:0 0 14px 0;">Inscription</h1>

        <span class="err" role="status" aria-live="polite" style="display:block; margin-bottom:12px;">
            <?php
                if (isset($_SESSION['errMdp'])) {
                    echo htmlspecialchars($_SESSION['errMdp'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                    $_SESSION['errMdp'] = "";
                }
                if (isset($_SESSION['errId'])) {
                    echo htmlspecialchars($_SESSION['errId'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                    $_SESSION['errId'] = "";
                }
                if (isset($_SESSION['creationOk'])) {
                    echo htmlspecialchars($_SESSION['creationOk'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                    $_SESSION['creationOk'] = "";
                }
                if (isset($_SESSION['creationNok'])) {
                    echo htmlspecialchars($_SESSION['creationNok'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                    $_SESSION['creationNok'] = "";
                }
            ?>
        </span>

        <form action="controleur/traitementFormInscription.php" method="POST" id="inscription" style="margin:0;">

            <div style="display:grid; gap:10px;">
                <div>
                    <label for="idUtilCreation" style="display:block; font-weight:600; margin-bottom:6px;">Identifiant</label>
                    <input
                        type="text"
                        placeholder="Choisir un nom d'utilisateur"
                        name="idUtilCreation"
                        id="idUtilCreation"
                        required
                        autocomplete="username"
                        maxlength="120"
                        style="
                            width:100%;
                            padding:10px 12px;
                            border:1px solid rgba(0,0,0,.2);
                            border-radius:10px;
                            outline:none;
                        "
                    >
                </div>

                <div>
                    <label for="pwdCreation" style="display:block; font-weight:600; margin-bottom:6px;">Mot de passe</label>
                    <input
                        type="password"
                        placeholder="Choisir un mot de passe"
                        name="pwdCreation"
                        id="pwdCreation"
                        required
                        autocomplete="new-password"
                        maxlength="120"
                        style="
                            width:100%;
                            padding:10px 12px;
                            border:1px solid rgba(0,0,0,.2);
                            border-radius:10px;
                            outline:none;
                        "
                    >
                </div>

                <div>
                    <label for="pwdBis" style="display:block; font-weight:600; margin-bottom:6px;">Confirmez le mot de passe</label>
                    <input
                        type="password"
                        placeholder="Ressaisir le mot de passe"
                        name="pwdBis"
                        id="pwdBis"
                        required
                        autocomplete="new-password"
                        maxlength="120"
                        style="
                            width:100%;
                            padding:10px 12px;
                            border:1px solid rgba(0,0,0,.2);
                            border-radius:10px;
                            outline:none;
                        "
                    >
                </div>

                <div style="display:flex; align-items:center; justify-content:space-between; gap:10px; margin-top:6px;">
                    <button
                        type="submit"
                        class="button"
                        style="
                            padding:10px 14px;
                            border-radius:10px;
                            border:1px solid rgba(0,0,0,.15);
                            cursor:pointer;
                        "
                    >
                        S'inscrire
                    </button>

                    <a href="connexion.php" style="text-decoration:none;">
                        Déjà inscrit ?
                    </a>
                </div>
            </div>

        </form>
    </div>

</main>

    <!--*************** PIED DE PAGE ***************-->
    <footer id="footer">
        <ul class="footer-links">
            <li class="footer-item">©Projet 3iL</li>
            <li class="footer-item"><a href="#" target="_blank"><img id="logo" src="images/facebook.webp"></a></li>
            <li class="footer-item">Site test</li>
            <ul/>
    </footer>

</body>

</html>

