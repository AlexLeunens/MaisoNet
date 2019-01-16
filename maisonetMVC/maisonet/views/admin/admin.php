<?php
$title = "User Interface";
$css = "/maisonet/views/admin/usermain.css";
require ROOT."/views/template/header.php";
?>


<body>

<img id="logo" src="/maisonet/views/admin/Images/logo_provisoire2.png"> </img>
<!--<a href="absent.html" ><img id="switch" src="Images-utilisateur/switchOn.png"> </img> </a> -->


<img class="avatar" src="/maisonet/views/admin/Images/avatar.png" onclick="openNav()"> </img>
<div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
    <a href="#">Profil</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
    <a href="index.php?action=logout">Se Déconnecter</a>
</div>




<div id="menu">  <!--conteneur-->
    <ul id="onglets">  <!--commence la liste et lui donne l'id onglet-->
        <li><a id="defaultOpen" href="javascript:openPage('Client', this)"> Client </a></li>
        <li><a href="javascript:openPage('Contact', this)"> Contact </a></li>
        <li><a href="javascript:openPage('Notification', this)"> Notification </a></li>
        <li><a href="javascript:openPage('GestClient', this)"> Gestion Client </a></li>

    </ul>
</div>


<div id= "Client" class="Elements">
    <form class="dossier" method="post" action="php/user_id.php">
        No. client : <input type="text" name="username" >
        <input  align="right" type="submit" value="Entrée" >
    </form>
    <p class="piece">Salon</p>
    <div class="panel">
        <div class=bloc><a href="#masque">
                <img class="imagestemperature" src="/maisonet/views/admin/Images/temperature+.png" alt="temperature"></img>
                <p class=sstitre>Votre Temperature</p></a>
        </div>
        <div class=bloc><a href="#masque">
                <img class="imagesbutton" src="/maisonet/views/admin/Images/volets2.png" alt="volets"></img>
                <p class=sstitre>Etat volet</p></a>
        </div>
    </div>

    <p class="piece">Chambre 1</p>
    <div class="panel">
        <div class=bloc><a href="#masque">
                <img class="imagestemperature" src="/maisonet/views/admin/Images/temperature+.png" alt="temperature"></img>
                <p class=sstitre>Votre Temperature</p></a>
        </div>
        <div class=bloc><a href="#masque">
                <img class="imagesbutton" src="/maisonet/views/admin/Images/volets2.png" alt="volets"></img>
                <p class=sstitre>Etat volet</p></a>
        </div>
    </div>

    <p class="piece">Salle A Manger</p>
    <div class="panel">
        <div class=bloc><a href="#masque">
                <img class="imagestemperature" src="/maisonet/views/admin/Images/temperature+.png" alt="temperature"></img>
                <p class=sstitre>Votre Temperature</p></a>
        </div>
        <div class=bloc><a href="#masque">
                <img class="imagesbutton" src="/maisonet/views/admin/Images/volets2.png" alt="volets"></img>
                <p class=sstitre>Etat volet</p></a>
        </div>
    </div>
</div>


<div id= "Contact" class="Elements" style="display:none;">
    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'dbmaisonet');

    if ($mysqli->connect_errno) {
        die('<p>Connexion impossible : '.$mysqli->connect_error.'</p>');
    }
    $result = $mysqli->query('SELECT nom, prenom FROM utilisateur;') ;
    if (!$result) {
        die('<p>ERREUR Requête invalide : '.$mysqli->error.'</p>');
    }
    while ($row = $result->fetch_assoc()) {
        $nom = $row['nom'] ;
        $prenom = $row['prenom'] ;
        echo '<p>'.$prenom.' '.$nom.'</p>'."\r\n" ;
    }
    $result->free() ;
    $mysqli->close() ;
    ?>
</div>
<div id= "Notification" class="Elements" style="display:none;">

</div>
<div id= "GestClient" class="Elements" style="display:none;">
    <div class = "newClientRegister">
        <form class="register" method="post" action="index.php?action=add_user">
            <h3>Ajouter un nouveau utilisateur</h3>
            <label for="inputLastName">Nom</label>
            <br>
            <input type="text" name="lastname" id="inputLastName"  placeholder="Nom" required autofocus>
            <br>
            <label for="inputName">Prénom</label>
            <br>
            <input type="text" name="name" id="inputName"  placeholder="Prénom" required>
            <br>
            <label for="inputPassword">Mot de passe</label>
            <br>
            <input type="password" name="password" id="inputPassword"  placeholder="Mot de pass" required>
            <br>
            <label for="inputEmail">Adress Mail</label>
            <br>
            <input type="email" name="email" id="inputEmail"  placeholder="Add Mail" required>
            <br>
            <label for="inputBirthday">Date de naissance</label>
            <br>
            <input type="date" name="birthday" id="inputBirthday"  placeholder="Date de naissance" required>
            <br>
            <label for="inputTel">Numéro de téléphone</label>
            <br>
            <input type="tel" name="tel" id="inputTel"  placeholder="Numéro de téléphone" required>
            <br>
            <?php displayType() ?>
            <br>
            <br>
            <input type="submit" value="Ajouter">
        </form>

        <?php

        function displayType(){
            $db = dbConnect();

            $sql = "SELECT Type FROM Fonction";
            $result = $db->query($sql);
            $i = 0;
            echo '<label for="type">Type</label><br>';
            echo '<select name="type">';
            while ($types = $result->fetch(PDO::FETCH_ASSOC)) {
                $i++;
                echo '<option value=' . $i . '>' . $types['Type'] . '</option>';
            }
            echo '</select>';



        }

        ?>

    </div>
</div>

<p class="help"> <img class="imageHelpMenu" src="/maisonet/views/admin/Images/helpmenu.png" alt="Help"></img> </p>
<div class="helpPanel">

    <a href="" onclick= "popupHelp()"><img class="imageshelp" src="/maisonet/views/admin/Images/helpquestionmark.png" alt="FAQ"></img></a>

    <a href="" onclick= "popupContact()"><img class="imageshelp" src="/maisonet/views/admin/Images/helptechnician.png" alt="Contact Tech"></img> </a>

</div>

<p><a href="#masque"></a></p>
<div id="masque">
    <div class="fenetre-modale">
        <a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre"
                                                 title="Fermer la fenêtre" class="btn-fermer"
                                                 src="Images/fmodale_fermer.jpg" /></a>
        <h2>Bonjour</h2>
        <form>
            <input type="button" value=" - " onClick="javascript:this.form.champ.value--;">
            <input type="text1" name="champ" value="0">°C
            <input type="button" value=" + " onClick="javascript:this.form.champ.value++;">
        </form>
    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->
<script>
    for (var piece = document.getElementsByClassName("piece"), panel = document.getElementsByClassName("panel"), i = 0; i < piece.length; i++) {
        piece[i].onclick = function () {
            var a = !this.classList.contains("active");
            setClass(piece, "active", "remove");
            setClass(panel, "show", "remove");
            a && (this.classList.toggle("active"), this.nextElementSibling.classList.toggle("show"));
        };
    }
    var help = document.getElementsByClassName("help"),
        helpPanel = document.getElementsByClassName("helpPanel");
    help[0].onclick = function () {
        var a = !this.classList.contains("active");
        setClass(help, "active", "remove");
        setClass(helpPanel, "show", "remove");
        a && (this.classList.toggle("active"), this.nextElementSibling.classList.toggle("show"));
    };

    function setClass(a, d, b) {
        for (var c = 0; c < a.length; c++) {
            a[c].classList[b](d);
        }
    }

    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    function popupHelp() {
        window.open("FAQ.html", "", "width=1200, height=1000");
    }

    function popupContact() {
        window.open("contact.html", "", "width=800, height=500, left=500px, top=200px");
    }

    function openPage(a, d) {
        var b;
        var c = document.getElementsByClassName("Elements");
        for (b = 0; b < c.length; b++) {
            c[b].style.display = "none";
        }
        document.getElementById(a).style.display = "block";
        d.classList.toggle("focus");
    }
    document.getElementById("defaultOpen").click();
</script>


</body>
</body>

</html>
