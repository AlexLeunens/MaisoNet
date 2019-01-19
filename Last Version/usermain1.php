<!doctype html>
<html lang="fr">
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
        header("Location: usermain1.php?idContact=" . $_GET['idContact'] . "&nom=" . $name . "&prenom=" . $firstname . "&Adresse=" . $adresse);

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


<img id="logo" src="Images-utilisateur/logo_provisoire2.png"> </img>
<!--<a href="absent.html" ><img id="switch" src="Images-utilisateur/switchOn.png"> </img> </a> -->


<img class="avatar" src="Images-utilisateur/avatar.png" onclick="openNav()"> </img>
<div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
    <a href="index.php?action=see_ourServices">Services</a>
    <a href="" onclick="popupContact()">Contact</a>
    <a href="index.php?action=logout">Se Déconnecter</a>
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

    <form class='dossier' method='post' action=''>
        Adresse de la Maison : <input type="text" name="adresse">
        <input align="right" type="submit" name="getMaison" value="Entrée">
    </form>

</div>


<div id="Contact" class="Elements" style="display:none;">
    <div id="contactWrapper">
        <ul id="myMenu">
            <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">

            <?php

            $sql = "SELECT idUtilisateur, nom, prenom FROM utilisateur;"; //utilisateurs in 172.16.223.113
            $result = $conn->query($sql);

            if (!$result) {
                die('<p>ERREUR Requête invalide : ' . $mysqli->error . '</p>');
            }

            while ($row = $result->fetch_assoc()) {
                // en minuscule dans l'autre
                echo "<li>";
                echo "<a href=usermain1.php?idContact=" . $row["idUtilisateur"] . "&nom=" . $_GET['nom'] . "&prenom=" . $_GET['prenom'] . "&Adresse=" . $_GET['Adresse'] . ">";
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
                    <input name="user_message" type="text" id="usermsg" required/>
                    <input name="submitmsg" type="submit" id="submitmsg" value="Send"/>
                </form>
            </div>

        </div>


    </div>
</div>
</div>


<div id="Notification" class="Elements" style="display:none;">

</div>
<div id="GestClient" class="Elements" style="display:none;">

</div>
<div id=GestAdmin class="Elements" style="display:none;">
    <p class="piece">Modifier Accueil</p>
    <div class="panel">
        <div class=bloc><a href="#masque1">
                <p class="sstitre">Qui sommes nous?</p></a>

        </div>
        <div class=bloc><a href="#masque1">
                <p class="sstitre">Que faisons nous?</p></a>
        </div>
        <div class=bloc><a href="#masque1">
                <p class="sstitre">Quels sont nos tarifs</p></a>
        </div>
    </div>
</div>




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


<div id="masque">
    <div class="fenetre-modale">
        <a class="fermer" href="#"><img alt="X" title="Fermer la fenêtre" class="btn-fermer"
                                        src="Images-utilisateur/fmodale_fermer.jpg"/></a>
        <h2>Votre Capteur:</h2>

        <form>
            <input type="button1" value=" - " onClick="javascript:this.form.champ.value--;">
            <input type="text1" name="champ" value="0">
            <input type="button1" value=" + " onClick="javascript:this.form.champ.value++;">
        </form>

    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="usermain1.js"></script>
<script>
    var auto_refresh = setInterval(
        function () {
            <?php
            echo "$('#Messages').load('messages.php?idContact=" . $_GET['idContact'] . "&nom=" . $_GET['nom'] . "&prenom=" . $_GET['prenom'] . "').fadeIn('slow');";
            ?>
        }, 1000); // refresh toutes les secondes

    <?php
    echo "$('#Client').load('afficheMaison.php?nom=" . $_GET['nom'] . "&prenom=" . $_GET['prenom'] . "&Adresse=" . $_GET['Adresse'] . "').fadeIn('slow');";
    ?>
</script>


</html>
