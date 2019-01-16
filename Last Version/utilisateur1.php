<!doctype html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title>User Interface</title>

    <link rel="stylesheet" href="utilisateur1.css"> <!--feuille css-->
    <link rel="icon" href="Images-utilisateur/maisonetlogo.png"> <!--icone-->
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/raleway" type="text/css"/>

</head>

<body>

<?php
include 'connect.php';
include 'headerMainUser.php';
include 'secure.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = Securite::bdd($conn, $_GET['nom']);
    $firstname = Securite::bdd($conn, $_GET['prenom']);
    //$name = $_SESSION["name"];
    //$firstname = $_SESSION["firstname"];
    if (isset($_POST['getMaison'])) {
        $adresse = str_replace(" ", "", $_POST['adresse']);
        header("Location: utilisateur1.php?idContact=" . $_GET['idContact'] . "&nom=" . $name . "&prenom=" . $firstname . "&Adresse=" . $adresse);
    } else if (isset($_POST['submitmsg'])) {
        $query = "BEGIN WORK;";
        $result = $conn->query($query);
        if (!$result) {
            echo "Erreur lors de l'envoi du message";
        }
        // gets the id of the current user
        $sql = "SELECT idUtilisateur FROM utilisateur WHERE utilisateur.Nom = '" . $name . "' AND utilisateur.prenom = '" . $firstname . "'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $reciever = $row["idUtilisateur"];
        }
        $sql = "INSERT INTO 
                    contact(idUtilisateur,
                            idReciever,
                          message) 
                VALUES (" . $_GET['idContact'] . ",
                        " . $reciever . ",
                        '" . mysqli_real_escape_string($conn, $_POST['user_message']) . "')";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Erreur lors de l'insertion du message dans la base de données";
            echo mysqli_error($conn);
            $sql = "ROLLBACK;";
            $result = $conn->query($query);
        } else {
            $sql = "COMMIT;";
            $result = $conn->query($sql);
            unset($_POST);
            echo "<script>";
            echo "$('#Messages').load('messages.php?idContact=" . $_GET['idContact'] . "&nom=" . $name . "&prenom=" . $firstname . "').fadeIn('slow');";
            echo "</script>";
        }
    }
}
?>



<img class="avatar" src="Images-utilisateur/avatar.png" onclick="openNav()"> </img>
<div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
    <a href="#">Profil</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
    <a href="#">Déconnexion</a>
</div>


<div id="menu">  <!--conteneur-->
    <img id="logo" src="Images-utilisateur/maisonlogolong.png"> </img>
    <ul id="onglets">  <!--commence la liste et lui donne l'id onglet-->
        <li id="liPresent" class="active"><a href="javascript:switchClick()"> Mode Présence </a></li>
        <li id="liAbsent"><a href="javascript:switchClick()"> Mode Absence </a></li>

        <label class="switch" onclick="openPage(this)">
            <input type="checkbox" id="switchPresence" unchecked>
            <span class="slider round"></span>
        </label>
    </ul>
</div>


<div id="Present" class="fonctions">

    <form class='dossier' method='post' action=''>
        Adresse de la Maison : <input type="text" name="adresse">
        <input align="right" type="submit" name="getMaison" value="Entrée">
    </form>

</div>


<div id="Absent" class="fonctions" style="display:none;">
    <p class="piece">Economies</p>
    <div class="panel">
        <div class="bloc">
            <img class="imagesbutton" src="Images-utilisateur/volets.png" alt="volets"></img>
            <p> Etat des Volets</p>
        </div>
        <div class="bloc">
            <img class="imagesbutton" src="Images-utilisateur/temperature.png" alt="temperature"></img>
            <p> Valeur Température</p>
        </div>
        <div class="bloc">
            <img class="imagesbutton" src="Images-utilisateur/humidity.png" alt="temperature"></img>
            <p> Valeur Humidité</p>
        </div>
        <div class="bloc">
            <img class="imagesbutton" src="Images-utilisateur/pollution.png" alt="temperature"></img>
            <p> Alerte : Fuite de Gaz</p>
        </div>
        <div class="bloc">
            <img class="imagesbutton" src="Images-utilisateur/fire_alarm.png" alt="temperature"></img>
            <p> Alerte : Fumée (Incendie)</p>
        </div>
    </div>

    <p class="piece">Sécurité</p>
    <div class="panel">
        <div class="bloc">
            <img class="imagesbutton" src="Images-utilisateur/pollution.png" alt="temperature"></img>
            <p> Alerte : Fuite de Gaz</p>
        </div>
        <div class="bloc">
            <img class="imagesbutton" src="Images-utilisateur/fire_alarm.png" alt="temperature"></img>
            <p> Alerte : Fumée (Incendie)</p>
        </div>
        <div class="bloc">
            <img class="imagesbutton" src="Images-utilisateur/camera.png" alt="volets"></img>
            <p> Système de Sécurité</p>
        </div>
    </div>
</div>


<p class="help"> ? </p>
<div class="helpPanel">

    <a href="" onclick="tabFAQ()"><img class="imageshelp" src="Images-utilisateur/helpquestionmark.png" alt="FAQ"></img></a>

    <a href="" onclick="popupContact()"><img class="imageshelp" src="Images-utilisateur/helptechnician.png" alt="Contact Tech"></img> </a>

</div>

<div id="masquetemp">
    <div class="fenetre-modale" id="garbage">
        <a class="fermer" href="javascript:closeShit()"><img alt="Bouton fermer la fenêtre"
                                                             title="Fermer la fenêtre" class="btn-fermer"
                                                             src="Images-utilisateur/Coix_sortie.png"/></a>
        <h2>Votre température:</h2>
        <form>
            <input type="button" value=" - " onClick="javascript:this.form.champ.value--;">
            <input type="text1" name="champ" value="0">%
            <input type="button" value=" + " onClick="javascript:this.form.champ.value++;">
        </form>
    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->

<div id="masquehum">
    <div class="fenetre-modale">
        <a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre"
                                                 title="Fermer la fenêtre" class="btn-fermer"
                                                 src="Images-utilisateur/Croix_sortie.png"/></a>
        <h2>Votre Humidité:</h2>
        <form>
            <input type="button" value=" - " onClick="javascript:this.form.champ.value--;">
            <input type="text1" name="champ" value="0">%
            <input type="button" value=" + " onClick="javascript:this.form.champ.value++;">
        </form>
    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->

<div id="masquefum">
    <div class="fenetre-modale">
        <a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre"
                                                 title="Fermer la fenêtre" class="btn-fermer"
                                                 src="Images-utilisateur/Croix_sortie.png"/></a>
        <h2>Etat:</h2>
    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->

<div id="masqueCO2">
    <div class="fenetre-modale">
        <a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre"
                                                 title="Fermer la fenêtre" class="btn-fermer"
                                                 src="Images-utilisateur/Croix_sortie.png"/></a>
        <h2>Etat:</h2>
    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->

<div id="masquecam">
    <div class="fenetre-modale">
        <a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre"
                                                 title="Fermer la fenêtre" class="btn-fermer"
                                                 src="Images-utilisateur/Croix_sortie.png"/></a>
        <h2>Etat:</h2>
    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->

<div id="masquevolet">
    <div class="fenetre-modale">
        <a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre"
                                                 title="Fermer la fenêtre" class="btn-fermer"
                                                 src="Images-utilisateur/Croix_sortie.png"/></a>
        <h2>Etat des volets:</h2>
        <!-- ICI Ajouter l'a liste des capteurs l'état ouvert ou fermé du volet -->
    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    <?php
    echo "$('#Present').load('afficheMaison.php?nom=" . $_GET['nom'] . "&prenom=" . $_GET['prenom'] . "&Adresse=" . $_GET['Adresse'] . "').fadeIn('slow');";
    ?>
</script>

<script>
    var piece = document.getElementsByClassName("piece");
    var panel = document.getElementsByClassName('panel'); //selec piece et panel
    for (var i = 0; i < piece.length; i++) { //pour tout bouton
        piece[i].onclick = function () {
            var setClasses = !this.classList.contains('active'); //selec classes actives qui ne sont pas celle sur laquelle on a cliqué
            setClass(piece, 'active', 'remove'); //les rend inactives
            setClass(panel, 'show', 'remove'); // cache le contenu
            if (setClasses) {
                this.classList.toggle("active"); //rend celle cliquée active (piece)
                this.nextElementSibling.classList.toggle("show"); //affiche le contenu (panel)
            }
        }
    }

    $(document).on("click", "p.piece", function () {
        var a = !this.classList.contains("active");
        setClass(piece, "active", "remove");
        setClass(panel, "show", "remove");
        a && (this.classList.toggle("active"), this.nextElementSibling.classList.toggle("show"));
    });


    var help = document.getElementsByClassName("help")
    var helpPanel = document.getElementsByClassName("helpPanel")
    help[0].onclick = function () {
        var setClasses = !this.classList.contains('active'); // vérifie si help actif
        setClass(help, 'active', 'remove'); //les rend inactives
        setClass(helpPanel, 'show', 'remove'); // cache le contenu
        if (setClasses) { //si help pas deja actif
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }

    function setClass(els, className, fnName) {
        for (var i = 0; i < els.length; i++) { //chaque piece selec avec !this.classList.contains('active')
            els[i].classList[fnName](className); //les prend une par une, puis désactive une propriété
        }
    }

    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    function popupHelp() {
        var myWindow = window.open("FAQ.html", "", "width=1200, height=1000");
    }

    function popupContact() {
        var myWindow = window.open("contact.html", "", "width=800, height=500, left=500px, top=200px");
    }

    function tabFAQ() {
        var win = window.open("FAQ.html", '_blank');
        win.focus();
    }

    function switchClick() {
        document.getElementById("switchPresence").click();
    }

    function openPage(elmnt) {
        var i, tabcontent, pageName, ongletActif;
        var checkBox = document.getElementById("switchPresence");
        var ongletPresent = document.getElementById("liPresent");
        var ongletAbsent = document.getElementById("liAbsent");
        tabcontent = document.getElementsByClassName("fonctions");

        if (checkBox.checked == true) {
            pageName = "Present";
            ongletAbsent.classList.remove("active"); /*update les onglets*/
            ongletPresent.classList.add("active");
        } else {
            pageName = "Absent";
            ongletPresent.classList.remove("active");
            ongletAbsent.classList.add("active");
        }
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none"; //hide all
        }
        document.getElementById(pageName).style.display = "grid"; //disp selected
    }

    if (document.getElementById("switchPresence").checked == false) {
        document.getElementById("switchPresence").click(); /*Permet d'update le switch lors d'un rafraichissement*/
    }

    function closeShit() {
        document.getElementById("garbage").style.display = "none";
    }
</script>


</body>

</html>