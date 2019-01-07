<!doctype html>
<html lang="fr">
<?php
include 'connect.php';
include 'headerMainUser.php';
?>


<img id="logo" src="Images-utilisateur/logo_provisoire2.png"> </img>
<!--<a href="absent.html" ><img id="switch" src="Images-utilisateur/switchOn.png"> </img> </a> -->


<img class="avatar" src="Images-utilisateur/avatar.png" onclick="openNav()"> </img>
<div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
    <a href="Nos_services.php">Services</a>
    <a href="" onclick="popupContact()">Contact</a>
    <a href="index.php">Se Déconnecter</a>
</div>


<div id="menu">  <!--conteneur-->
    <ul id="onglets">  <!--commence la liste et lui donne l'id onglet-->
        <li><a id="defaultOpen" href="javascript:openPage('Client', this)"> Client </a></li>
        <li><a href="javascript:openPage('Contact', this)"> Contact </a></li>
        <li><a href="javascript:openPage('Notification', this)"> Notification </a></li>
        <li><a href="javascript:openPage('GestClient', this)"> Gestion Client </a></li>
        <li><a href="javascript:openPage('GestAdmin',this)"> Gestion Admin </a></li>

    </ul>
</div>


<div id="Client" class="Elements">
    <form class="dossier" method="post" action="php/user_id.php">
        No. client : <input type="text" name="username">
        <input align="right" type="submit" value="Entrée">
    </form>
    <p class="piece">Salon</p>
    <div class="panel">
        <div class=bloc><a href="#masquetemp">
                <img class="imagestemperature" src="Images-utilisateur/temperature+.png" alt="temperature"></img>
                <p class=sstitre>Votre Temperature</p></a>
        </div>
        <div class=bloc><a href="#masquevolet">
                <img class="imagesbutton" src="Images-utilisateur/volet.png" alt="volets"></img>
                <p class=sstitre>Etat volet</p></a>
        </div>
        <div class=bloc><a href="#masqueplus">
                <img class="imagesbuttonplus" src="Images-utilisateur/plus.png" alt="plus"></img>
                <p class=sstitre>Etat volet</p></a>
        </div>
    </div>

    <p class="piece">Chambre 1</p>
    <div class="panel">
        <div class=bloc><a href="#masquetemp">
                <img class="imagestemperature" src="Images-utilisateur/temperature+.png" alt="temperature"></img>
                <p class=sstitre>Votre Temperature</p></a>
        </div>
        <div class=bloc><a href="#masquevolet">
                <img class="imagesbutton" src="Images-utilisateur/volet.png" alt="volets"></img>
                <p class=sstitre>Etat volet</p></a>
        </div>
        <div class=bloc><a href="#masqueplus">
                <img class="imagesbuttonplus" src="Images-utilisateur/plus.png" alt="plus"></img>
                <p class=sstitre>Etat volet</p></a>
        </div>
    </div>

    <p class="piece">Salle A Manger</p>
    <div class="panel">
        <div class=bloc><a href="#masquetemp">
                <img class="imagestemperature" src="Images-utilisateur/temperature+.png" alt="temperature"></img>
                <p class=sstitre>Votre Temperature</p></a>
        </div>
        <div class=bloc><a href="#masquevolet">
                <img class="imagesbutton" src="Images-utilisateur/volet.png" alt="volets"></img>
                <p class=sstitre>Etat volet</p></a>
        </div>
        <div class=bloc><a href="#masqueplus">
                <img class="imagesbuttonplus" src="Images-utilisateur/plus.png" alt="plus"></img>
                <p class=sstitre>Etat volet</p></a>
        </div>
    </div>
</div>


<div id="Contact" class="Elements" style="display:none;">
    <div id="contactWrapper">
        <ul id="myMenu">
            <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">

            <?php
            /*
             *
             $mysqli = new mysqli('172.16.233.113', '', '', 'formation_mysql');
            if ($mysqli->connect_errno) {
                die('<p>Connexion impossible : '.$mysqli->connect_error.'</p>');
            }*/

            $sql = "SELECT idUtilisateur, nom, prenom FROM utilisateur;"; //utilisateurs in 172.16.223.113
            $result = $conn->query($sql); //$mysqli

            if (!$result) {
                die('<p>ERREUR Requête invalide : ' . $mysqli->error . '</p>');
            }

            while ($row = $result->fetch_assoc()) {
                // en minuscule dans l'autre
                echo "<li>";
                echo "<a href=usermain1.php?idContact=" . $row["idUtilisateur"] . ">";
                echo $row["nom"] . "" . $row['prenom'];
                echo "</a>";
                echo "</li>";
                echo "\n";
            }

            $result->free();
            ?>
        </ul>
        <div id="discussion">
            <div id="Messages">

            </div>
            <div id="chatbox">
                <form method="post" name="message">
                    <input name="user_message" type="text" id="usermsg"/>
                    <input name="submitmsg" type="submit" id="submitmsg" value="Send"/>
                </form>
            </div>

        </div>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
        <script>
            var auto_refresh = setInterval(
                function() {
                    <?php
                    echo "$('#Messages').load('messages.php?idContact=".$_GET['idContact']."').fadeIn('slow');";
                    ?>
                }, 1000); // refresh toutes les secondes
        </script>


    </div>
</div>
</div>

<script>
    $('#submitmsg').click(function() {
        $.ajax({
            url: 'postmessage.php',
            type: 'POST',
            data: {
                idUtilisateur: '$("input#usermsg").val()',
                message: '$("input#usermsg").val()'
            }
        });
    });
</script>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "BEGIN WORK;";
    $result = $conn->query($query);
    if (!$result) {
        //Damn! the query failed, quit
        echo 'An error occurred while creating your topic. Please try again later.';
    }
    //TODO : requete avec senderID (doit être ajouté a la table)
    $sql = "INSERT INTO 
                    contact(idUtilisateur,
                          message) 
                VALUES (1,
                        '" . $_POST['user_message'] . "')";

    $result = $conn->query($sql);
    if (!$result) {
        //something went wrong, display the error
        echo 'An error occured while inserting your data. Please try again later.';
        echo mysqli_error($conn);
        $sql = "ROLLBACK;";
        $result = $conn->query($query);
    } else {
        $sql = "COMMIT;";
        $result = $conn->query($sql);

        //after a lot of work, the query succeeded!
        unset($_POST);

        echo "<script>";
        echo "$('#Messages').load('messages.php?idContact=".$_GET['idContact']."').fadeIn('slow');";
        echo "</script>";
    }
}
?>

<div id="Notification" class="Elements" style="display:none;">

</div>
<div id="GestClient" class="Elments" style="display:none;">

</div>
<div id=GestAdmin class="Elements" style="display:none;">
    <p class="piece">Modifier Accueil</p>
    <div class="panel">
        <div class=bloc><a href="#masque1">
                <p class="sstitre">Presentation</p></a>

        </div>
    </div>
</div>

<p><a href="#masquetemp"></a></p>
<div id="masquetemp">
    <div class="fenetre-modale">
        <a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre"
                                                 title="Fermer la fenêtre" class="btn-fermer"
                                                 src="Images-utilisateur/fmodale_fermer.jpg"/></a>
        <h2>Votre température:</h2>
        <form>
            <input type="button1" value=" - " onClick="javascript:this.form.champ.value--;">
            <input type="text1" name="champ" value="0">°C
            <input type="button1" value=" + " onClick="javascript:this.form.champ.value++;">
        </form>
    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->
<p><a href="#masquevolet"></a></p>
<div id="masquevolet">
    <div class="fenetre-modale">
        <a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre"
                                                 title="Fermer la fenêtre" class="btn-fermer"
                                                 src="Images-utilisateur/fmodale_fermer.jpg"/></a>
        <h2>Etat des volets:</h2>
        <!-- ICI Ajouter l'a liste des capteurs l'état ouvert ou fermé du volet -->
    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->
<p><a href="#masqueplus"></a></p>
<div id="masqueplus">
    <div class="fenetre-modale">
        <a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre"
                                                 title="Fermer la fenêtre" class="btn-fermer"
                                                 src="Images-utilisateur/fmodale_fermer.jpg"/></a>
        <h2>Quel capteur voulez vous ajouter:</h2>
        <!-- ICI Ajouter la liste des capteurs -->
    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->
<p><a href="#masque1"></a></p>
<div id="masque1">
    <div class="fenetre-modale">
        <a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre"
                                                 title="Fermer la fenêtre" class="btn-fermer"
                                                 src="Images-utilisateur/fmodale_fermer.jpg"/></a>
        <h2>Entrez le texte</h2>
        <form>
            <input type="button" value="G" style="font-weight: bold;" onclick="commande('bold');"/>
            <input type="button" value="I" style="font-style: italic;" onclick="commande('italic');"/>
            <input type="button" value="S" style="text-decoration: underline;" onclick="commande('underline');"/>
            <div class="editeur" contenteditable></div>
            <input type="button" value="Enter"/>
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


    function myFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("mySearch");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myMenu");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>
<?php
if (!empty($_GET)) {
    echo "<script type='text/javascript'>";
    echo "javascript:openPage('Contact', this);";
    echo "</script>";
}
?>


</html>
