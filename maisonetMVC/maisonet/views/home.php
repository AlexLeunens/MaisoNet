<?php
$title ="Accueil - MaisoNET";
$css = "/maisonet/views/accueil.css";
require ROOT."/views/template/header.php";
?>



<body>

<div class = "menu">
    <img id="logo1" src="Images-accueil/maisonlogolong.png" > </img>
    <a href="index.php?action=see_login" class="button">Se Connecter</a>
    <a href="index.php?action=see_register" class="button">S'inscrire</a>
</div>

<div class = "presentation">
    <div class="card">
        <img class="imgCard" src="Images-accueil/maisonetlogo.png" alt="Avatar">
        <div class="container">
            <h4><b>Qui sommes nous ?</b></h4>
            <p>MaisoNet est un service de maison connectée proposé par la société DomISEP.</p>
        </div>
    </div>

    <div class="card">
        <img class="imgCard" src="Images-accueil/helpquestionmark.png" alt="Avatar">
        <div class="container">
            <h4><b>Que faisons nous ?</b></h4>
            <p>Descriptif</p>
        </div>
    </div>

    <div class="card">
        <img class="imgCard" src="Images-accueil/money.png" alt="Avatar">
        <div class="container">
            <h4><b>Quels sont nos tarifs ?</b></h4>
            <p>Descriptif</p>
        </div>
    </div>
</div>
<div class="forum">
    <h2>Pour plus d'informations, contactez nous ... ou venez sur notre <a href="index.php?action=see_forum">forum</a>!<h2> <!--lien hypertexte-->
</div>
</body>

</html>
