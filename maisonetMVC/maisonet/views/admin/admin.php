<?php
$title = "User Interface";
$css = "/maisonet/views/admin/usermain.css";
require ROOT . "/views/template/headerAdmin.php";
?>
<?php
include ROOT . "/models/connect.php";
include_once ROOT . "/models/secure.php";
//include_once ROOT."/models/model.php";

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();

}else{

if($_SESSION['type']==3){
    echo "<script>alert('vous êtes un utilisateur')</script>";
    header('Location: index.php?action=see_userPage');

}
}

if (!isset($_SESSION["name"]) || !isset($_SESSION["firstname"])) {
    $_SESSION["name"] = 'Anonym';
    $_SESSION["firstname"] = 'Name';
}

$name = $_SESSION["name"];
$firstname = $_SESSION["firstname"];


if (isset($_SESSION["idContact"])) {
    $idContact = $_SESSION["idContact"];
} else {
    $idContact = 1; //permet de toujours avoir un contact
}


if (isset($_SESSION["adresse"])) {
    $adresse = $_SESSION["adresse"];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['getMaison'])) {

        $adresse = htmlspecialchars($_POST['adresse']);  //str_replace(" ", "", $_POST['adresse']);
        $_SESSION["adresse"] = $adresse;

        //header("Location: views\admin\admin.php");

        //afficheMaison($conn,$name,$firstname,$adresse);

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
                VALUES (" . $idContact . ",
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
            echo "$('#Messages').load('messages.php?idContact=" . $idContact . "&nom=" . $name . "&prenom=" . $firstname . "').fadeIn('slow');";
            echo "</script>";
        }
    }

}
?>


<body>

<img id="logo" src="/maisonet/views/admin/Images/logo_provisoire2.png"> </img>
<!--<a href="absent.html" ><img id="switch" src="Images-utilisateur/switchOn.png"> </img> </a> -->


<img class="avatar" src="Images-utilisateur/avatar.png" onclick="openNav()"> </img>
<div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
    <a href="index.php?action=see_ourServices">Services</a>
    <a href="index.php?action=see_forum">Forum</a>
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
                echo "<li>";
                echo "<a href='' onclick=\" $('#Messages').load('messages.php?idContact=" . $row["idUtilisateur"] . "&nom=" . $name . "&prenom=" . $firstname . "').fadeIn('slow');\">";

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
    <div class="newClientRegister">
        <form class="register" method="post" action="index.php?action=add_user">
            <h3>Ajouter un nouveau utilisateur</h3>
            <label for="inputLastName">Nom</label>
            <br>
            <input type="text" name="lastname" id="inputLastName" placeholder="Nom" required autofocus>
            <br>
            <label for="inputName">Prénom</label>
            <br>
            <input type="text" name="name" id="inputName" placeholder="Prénom" required>
            <br>
            <label for="inputPassword">Mot de passe</label>
            <br>
            <input type="password" name="password" id="inputPassword" placeholder="Mot de pass" required>
            <br>
            <label for="inputEmail">Adress Mail</label>
            <br>
            <input type="email" name="email" id="inputEmail" placeholder="Add Mail" required>
            <br>
            <label for="inputBirthday">Date de naissance</label>
            <br>
            <input type="date" name="birthday" id="inputBirthday" placeholder="Date de naissance" required>
            <br>
            <label for="inputTel">Numéro de téléphone</label>
            <br>
            <input type="tel" name="tel" id="inputTel" placeholder="Numéro de téléphone" required>
            <br>
            <?php displayType() ?>
            <br>
            <br>
            <input type="submit" value="Ajouter">
        </form>

        <form class="addHouse" method="post" action="index.php?action=add_house">
            <h3>Ajouter une nouvelle maison</h3>
            <label for="inputUserId">ID utilisateur</label>
            <br>
            <input type="text" name="userId" id="inputUserId" placeholder="id" required autofocus>
            <br>
            <label for="inputAdress">Adresse</label>
            <br>
            <input type="text" name="adresse" id="inputAdress" placeholder="Adresse" required>
            <br>
            <label for="inputCodePostal">Code postal</label>
            <br>
            <input type="number" name="codePostal" id="inputCodePostal" placeholder="Code postal" required>
            <br>
            <?php displayPays() ?>
            <br>
            <br>
            <input type="submit" value="Ajouter">
        </form>

        <form class="addRoom" method="post" action="index.php?action=add_room">
            <h3>Ajouter une nouvelle pièce</h3>
            <label for="inputAdress">Adresse</label>
            <br>
            <input type="text" name="adresse" id="inputAdress" placeholder="Adresse" required>
            <br>
            <label for="inputRoomName">Nom de la pièce</label>
            <br>
            <input type="text" name="roomName" id="inputRoomName" placeholder="Nom de la pièce" required>
            <br>
            <br>
            <input type="submit" value="Ajouter">
        </form>


        <?php

        function displayType()
        {
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

        function displayPays()
        {
            $db = dbConnect();

            $sql = "SELECT nom FROM pays";
            $result = $db->query($sql);
            $i = 0;
            echo '<label for="pay">Pay</label><br>';
            echo '<select name="pay">';
            while ($pays = $result->fetch(PDO::FETCH_ASSOC)) {
                $i++;
                echo '<option value=' . $i . '>' . $pays['nom'] . '</option>';
            }
            echo '</select>';

        }


        ?>

    </div>
</div>

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

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="views/admin/usermain1.js"></script>
<script>
    var auto_refresh = setInterval(
        function () {
            <?php
            echo "$('#Messages').load('messages.php?idContact=" . $idContact . "&nom=" . $name . "&prenom=" . $firstname . "').fadeIn('slow');";
            ?>
        }, 1000); // refresh toutes les secondes

    <?php
    if (isset($adresse)) {
        echo "$('#Client').load('afficheMaison.php?nom=" . $name . "&prenom=" . $firstname . "&Adresse=" . $adresse . "').fadeIn('slow');";
    }
    ?>
</script>


</html>
