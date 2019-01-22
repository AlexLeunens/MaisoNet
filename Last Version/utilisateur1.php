<!doctype html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title>User Interface</title>

    <link rel="icon" href="Images-utilisateur/maisonetlogo.png"> <!--icone-->
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/raleway" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="utilisateur1.css"> <!--feuille css-->

</head>

<body>

<?php
include 'connect.php';
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

<div id="masque">
    <div class="fenetre-modale">
        <a class="fermer" href="#">X</a>
        <h2>Votre Capteur:</h2>

        <form>
            <input type="button1" value=" - " onClick="javascript:this.form.champ.value--;">
            <input type="text1" name="champ" value="0">
            <input type="button1" value=" + " onClick="javascript:this.form.champ.value++;">
        </form>

    </div> <!-- .fenetre-modale -->
</div> <!-- #masque -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="utilisateur1.js"></script>
<script>
    <?php
    echo "$('#Present').load('afficheMaison.php?nom=" . $_GET['nom'] . "&prenom=" . $_GET['prenom'] . "&Adresse=" . $_GET['Adresse'] . "').fadeIn('slow');";
    ?>
</script>


</body>

</html>
