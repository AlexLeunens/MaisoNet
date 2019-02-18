<?php
$title = "User Interface";
$css = "/maisonet/views/admin/usermain.css";
require ROOT . "/views/template/headerAdmin.php";
include ROOT . "/models/connect.php";
include_once ROOT . "/models/secure.php";
//include_once ROOT."/models/model.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();

} else {

    if ($_SESSION['type'] == 3) {
        echo "<script>alert('vous êtes un utilisateur')</script>";
        header('Location: index.php?action=see_userPage');

    }
}

//DEBUG
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

        $adresse = str_replace(" ", "", $_POST['adresse']);
        $_SESSION["adresse"] = $adresse;


    }

}
?>


<body>


<!--<a href="absent.html" ><img id="switch" src="Images-utilisateur/switchOn.png"> </img> </a> -->


<img class="avatar" src="views/admin/Images-utilisateur/avatar.png" onclick="openNav()"> </img>
<div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
    <a href="index.php?action=see_ourServices">Services</a>
    <a href="index.php?action=see_forum">Forum</a>
    <a href="" onclick="popupContact()">Contact</a>
    <a href="index.php?action=logout">Se Déconnecter</a>
</div>


<div id="menu">  <!--conteneur-->
    <img id="logo" src="views/admin/Images/logo_provisoire2.png"> </img>

    <ul id="onglets">  <!--commence la liste et lui donne l'id onglet-->
        <li><a id="defaultOpen" href="javascript:openPage('Client', this)"> Client </a></li>
        <li><a href="javascript:openPage('Contact', this)"> Contact </a></li>
        <li><a href="javascript:openPage('GestClient', this)"> Gestion Client </a></li>
        <li><a href="javascript:openPage('GestAdmin',this)"> Gestion Admin </a></li>
    </ul>

    <p class="modeText">Mode Administrateur</p>

</div>


<div id="Client" class="Elements">

    <form class='dossier' method='post' action=''>
        <label for="text">Choisissez la maison du Client :</label>
        <?php
        $sql = "SELECT * FROM maison";
        $result = $conn->query($sql);
        $incrementDropdown = 0;

        echo "<select name='adresse'>";
        while ($maisons = $result->fetch_assoc()) {
            $incrementDropdown++;
            echo "<option value='" . $maisons["Adresse"] . "'>" . $maisons["Adresse"] . "</option>";
        }
        echo "</select>";
        ?>
        <input align="right" type="submit" name="getMaison" value="Entrée">
    </form>

    <div id="afficheMaisonsAdmin"></div>


</div>


<div id="Contact" class="Elements" style="display:none;">
    <div id="contactWrapper">
        <ul id="myMenu">
            <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">

            <?php

            $sql = "SELECT idUtilisateur, nom, prenom FROM utilisateur;";
            $result = $conn->query($sql);

            if (!$result) {
                die('<p>ERREUR Requête invalide : ' . $mysqli->error . '</p>');
            }

            while ($row = $result->fetch_assoc()) {
                echo "<li>";

                $idContact = $row['idUtilisateur'];
                $name = $row["nom"];
                $firstname = $row['prenom'];

                echo "<a onclick=\" $('#Messages').load('messages.php?nom=" . $name . "&prenom=" . $firstname . "').fadeIn('slow');\">";

                echo $name . "" . $firstname;
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
                <form method='post' id='message' name="message" ;>
                    <input name="user_message" type="text" id="usermsg" required/>
                    <input name="submitmsg" id="submitmsg" type="button" onclick="sendChat()" value="Send"/>
                </form>
            </div>

        </div>


    </div>
</div>
</div>


<div id="GestClient" class="Elements" style="display:none;">
    <div class="newClientRegister">

        <form class="register" method="post" action="index.php?action=add_user">
            <h3>Ajouter un nouvel utilisateur</h3>

            <label for="inputLastName">Nom</label>
            <div>
                <input type="text" name="lastname" id="inputLastName" placeholder="Nom" required autofocus>
                <input type="text" name="name" id="inputName" placeholder="Prénom" required>
            </div>

            <label for="inputPassword">Mot de passe</label>
            <input type="password" name="password" id="inputPassword" placeholder="Mot de passe" required>

            <label for="inputEmail">E-Mail</label>
            <input type="email" name="email" id="inputEmail" placeholder="E-Mail" required>

            <label for="inputBirthday">Date de naissance</label>
            <input type="date" name="birthday" id="inputBirthday" placeholder="Date de naissance" required>

            <label for="inputTel">Numéro de téléphone</label>
            <input type="tel" name="tel" id="inputTel" placeholder="Numéro de téléphone" required>

            <?php displayType() ?>

            <input type="submit" value="Ajouter">
        </form>


        <?php
        function displayType() {
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

</div>
<div id=GestAdmin class="Elements" style="display:none;">

    <form class="addPay" method="post" action="index.php?action=add_pay">
        <h3>Ajouter un nouveau pay</h3>
        <label for="inputPayName">Nom du pay</label>
        <br>
        <input type="text" name="nomPay" id="inputPayName" placeholder="nom" required>
        <br>
        <br>
        <input type="submit" value="Ajouter">

    </form>

    <form class="addCapteurType" method="post" action="index.php?action=add_capteurType">
        <h3>Ajouter un noouveau type de capteur</h3>
        <label for="inputCapteurType">Type</label>
        <br>
        <input type="text" name="capteurType" id="inputCapteurType" placeholder="type" required>
        <br>
        <br>
        <input type="submit" value="Ajouter">

    </form>

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

<?php
//TODO modifier l'accueil.
// a true dumpster fire this page, never should have left it
?>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="views/admin/usermain1.js"></script>
<script>

    <?php
    if (isset($adresse)) {
        echo "$('#afficheMaisonsAdmin').load('afficheMaison.php').fadeIn('slow');";
    }
    ?>

    function toggle_visibility(id) {
        var e = document.getElementById(id);
        if (e.style.display == 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
    }


    function sendChat() {

        var formData = {
            'user_message':  $('#usermsg').val()
        };

        $.ajax({
            type: "POST",
            url: "sendMessage.php",
            data: formData,
            dataType: "text", //was json but hey

            success: function (data) {
                $('#usermsg').val("");
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown); alert($('#usermsg').val());
            }
        });


    }

</script>


</html>
