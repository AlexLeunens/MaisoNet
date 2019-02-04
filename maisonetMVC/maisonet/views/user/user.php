<?php
$title = "User Interface";
$css = "/maisonet/views/user/utilisateur1.css";
require ROOT . "/views/template/headerMainUser.php";
include ROOT . "/models/connect.php";
include_once ROOT . "/models/secure.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();

}

if (isset($_SESSION["adresse"])) {
    $adresse = $_SESSION["adresse"];
}

?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //$name = Securite::bdd($conn, $_GET['nom']);
    //$firstname = Securite::bdd($conn, $_GET['prenom']);
    $name = $_SESSION["name"];
    $firstname = $_SESSION["firstname"];

    if (isset($_POST['getMaison'])) {

        $adresse = str_replace(" ", "", $_POST['adresse']);
        $_SESSION["adresse"] = $adresse;

    }
}
?>

<body>

<img class="avatar" src="views/user/Images-utilisateur/avatar.png" onclick="openNav()"> </img>
<div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
    <a href="#">Profil</a>
    <a href="index.php?action=see_ourServices">Services</a>
    <a href="#">Contact</a>
    <a href="index.php?action=see_forum">Forum</a>
    <a href="index.php?action=logout">Déconnexion</a>
</div>


<div id="menu">  <!--conteneur-->
    <img id="logo" src="/maisonet/views/user/Images-utilisateur/logo_provisoire2.png"> </img>

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
        <div class="block">
            <img class="imagesbutton" src="views/user/Images-utilisateur/temperature.png" alt="temperature"></img>
            <p>Valeur température</p>
        </div>
        <div class="block">
            <img class="imagesbutton" src="views/user/Images-utilisateur/volet.png" alt="volets"></img>
            <p> Etat des volets</p>
        </div>
    </div>

    <p class="piece">Sécurité</p>
    <div class="panel">
        <div class="block">
            <img class="imagesbutton" src="/maisonet/views/user/Images-utilisateur/temperature+.png" alt="temperature"></img>
            <p>Valeur température</p>
        </div>
        <div class="block">
            <img class="imagesbutton" src="/maisonet/views/user/Images-utilisateur/volets2.png" alt="volets"></img>
            <p> Etat des volets</p>
        </div>
    </div>
</div>


<p class="help"> ? </p>
<div class="helpPanel">

    <a href="" onclick="tabFAQ()"><img class="imageshelp" src="/maisonet/views/user/Images-utilisateur/helpquestionmark.png" alt="FAQ"></img></a>

    <a href="" onclick="popupContact()"><img class="imageshelp" src="/maisonet/views/user/Images-utilisateur/helptechnician.png" alt="Contact Tech"></img> </a>

    <img class="imageshelp" src="/maisonet/views/user/Images-utilisateur/helpadministrator.png" alt="Contact Admin"></img>

</div>


<div id="masque">
    <div class="fenetre-modale">
        <a class="fermer" href="#"><img alt="X" title="Fermer la fenêtre" class="btn-fermer"
                                        src="views/admin/Images-utilisateur/fmodale_fermer.png"/></a>
        <h2>Votre Capteur:</h2>

        <form>
            <input type="button1" value=" - " onClick="javascript:this.form.champ.value--;">
            <input type="text1" name="champ" value="0">
            <input type="button1" value=" + " onClick="javascript:this.form.champ.value++;">
        </form>

    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>


    var piece = document.getElementsByClassName("piece");
    var panel = document.getElementsByClassName('panel'); //selec piece et panel
    for (var i = 0; i < piece.length; i++) { //pour tout bouton
        piece[i].onclick = function () {
            var setClasses = !this.classList.contains('active'); //selec classes actives qui ne sont pas celle sur laquelle on clique
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
        var myWindow = window.open("views/FAQ/FAQ.php", "", "width=1200, height=1000");
    }

    function popupContact() {
        var myWindow = window.open("contact.html", "", "width=800, height=500, left=500px, top=200px");
    }

    function tabFAQ() {
        var win = window.open("views/FAQ/FAQ.php", '_blank');
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
        document.getElementById("switchPresence").click(); // Update le switch lors d'un rafraichissement
    }

    <?php
    if (isset($adresse)) {
        echo "$('#Present').load('afficheMaison.php').fadeIn('slow');";
    }
    ?>

</script>


</body>

</html>
