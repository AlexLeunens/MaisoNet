<?php
//TODO implementer l'ajout de maison

$title = "User Interface";
$css = "/maisonet/views/user/utilisateur1.css";
require ROOT . "/views/template/headerMainUser.php";
include ROOT . "/models/connect.php";
include_once ROOT . "/models/secure.php";
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// DEBUG
$_SESSION["name"] = "Anonym";
$_SESSION["firstname"] = "Name";
$_SESSION['type'] = 2;
if (isset($_SESSION["adresse"])) {
    $adresse = $_SESSION["adresse"];
}
// Get user id
$sql = "SELECT idUtilisateur FROM utilisateur WHERE utilisateur.Nom = '" . $_SESSION["name"] . "' AND utilisateur.prenom = '" . $_SESSION["firstname"] . "'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $_SESSION['idUser'] = $row["idUtilisateur"];
}
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST["adresse"])) {
        $adresse = str_replace(" ", "", $_POST['adresse']);
        $_SESSION["adresse"] = $adresse;

        unset($_POST); // unsets the data sent to avoid re-sending it
        header("Location: " . $_SERVER['REQUEST_URL']); // refresh page to clear cache
    }

    if (!empty($_POST["newPiece"])) {

        $sql = "SELECT idMaison FROM maison WHERE maison.Adresse = '" . $_SESSION['adresse'] . "'";
        $result = $conn->query($sql);
        $maison = $result->fetch_assoc();
        $idMaison = $maison["idMaison"];

        $sql = "INSERT INTO 
                    piece(Nom, Maison_idMaison) 
                VALUES ('" . $_POST["newPiece"] . "',
                        " . $idMaison . ")";
        $result = $conn->query($sql);

        unset($_POST);
        header("Location: " . $_SERVER['REQUEST_URL']);
    }

    if (!empty($_POST["pieces"])) {
        $sql = "INSERT INTO 
                    capteur(Type,
                            Etat,
                          Affichage,
                            Piece_idPiece) 
                VALUES ('" . $_POST["type"] . "',
                        'actif',
                        'actif',
                        " . $_POST["pieces"] . ")";

        $result = $conn->query($sql);
        if (!$result) {
            echo "Erreur lors de l'insertion du capteur dans la base de données";
            echo mysqli_error($conn);
            $sql = "ROLLBACK;";
            $result = $conn->query($query);
        } else {
            $sql = "COMMIT;";
            $result = $conn->query($sql);
        }

        unset($_POST);
        header("Location: " . $_SERVER['REQUEST_URL']);
    }

    if (!empty($_POST["removeCapteurPiece"])) {
        $sql = "DELETE FROM `capteur` WHERE `capteur`.`idCapteur` = " . $_POST["removeCapteurPiece"] . " ";

        $result = $conn->query($sql);
        if (!$result) {
            echo "Erreur lors de la suppression du capteur dans la base de données";
            echo mysqli_error($conn);
            $sql = "ROLLBACK;";
            $result = $conn->query($query);
        } else {
            $sql = "COMMIT;";
            $result = $conn->query($sql);
        }

        unset($_POST);
        header("Location: " . $_SERVER['REQUEST_URL']);
    }

    if (!empty($_POST["removePiece"])) {
        $sql = "DELETE FROM `piece` WHERE `piece`.`idPiece` = " . $_POST["removePiece"] . " ";

        $result = $conn->query($sql);
        if (!$result) {
            echo "Erreur lors de la suppression de la piece dans la base de données";
            echo mysqli_error($conn);
            $sql = "ROLLBACK;";
            $result = $conn->query($query);
        } else {
            $sql = "COMMIT;";
            $result = $conn->query($sql);
        }

        unset($_POST);
        header("Location: " . $_SERVER['REQUEST_URL']);
    }
}
?>

<body>

<img class="avatar" src="views/user/Images-utilisateur/avatar.png" onclick="openNav()"> </img>
<div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
    <a href="#">Profil</a>
    <a href="index.php?action=see_ourServices">Services</a>
    <a href="" onclick="tabFAQ()">FAQ</a>
    <a href="index.php?action=see_forum">Forum</a>
    <a href="index.php?action=logout">Déconnexion</a>
</div>


<div id="menu">  <!--conteneur-->
    <img id="logo" src="views/user/Images-utilisateur/maisonlogolong.png"> </img>

    <ul id="onglets">  <!--commence la liste et lui donne l'id onglet-->
        <li id="liPresent" class="active"><a href="javascript:switchClick()"> Mode Présence </a></li>
        <li id="liAbsent"><a href="javascript:switchClick()"> Mode Absence </a></li>

        <label class="switch" onclick="openPage(this)">
            <input type="checkbox" id="switchPresence" unchecked>
            <span class="slider round"></span>
        </label>
    </ul>

    <form method='post' action=''>
        <label for="text">Choississez votre maison :</label>
        <?php
        $sql = "SELECT Adresse FROM maison WHERE Utilisateur_idUtilisateur =" . $_SESSION['idUser'] . " ";
        $result = $conn->query($sql);
        $incrementDropdown = 0;
        echo "<select name='adresse'>";
        while ($maisonsUser = $result->fetch_assoc()) {
            $incrementDropdown++;
            echo "<option value='" . $maisonsUser["Adresse"] . "'>" . $maisonsUser["Adresse"] . "</option>";
        }
        echo "</select>";
        ?>
        <input align="right" type="submit" name="submitCapteur" value="Entrée">
    </form>
</div>


<div id="Present" >

    <div id="maisonAffiche" class="fonctions"></div>

</div>


<div id="Absent" class="fonctions" style="display:none;">
    <p class="piece">Economies</p>
    <div class="panel">
        <div class="block">
        </div>
    </div>

    <p class="piece">Sécurité</p>
    <div class="panel">
        <div class="block">
        </div>
    </div>
</div>


<li id="addCapteur"><p class="addCapteur">+</p></li>
<div id="ajoutCapteur" class="modal">

    <div class="modal-content">
        <span class="close">&times;</span>

        <form class="addPiece" method="post" action=''>
            <h3>Ajouter une Nouvelle Pièce</h3>

            <label for="addPiece" name="piece">Nom de votre pièce</label>
            <input name="newPiece" type="text"/>
            <?php
            if (empty($_SESSION['adresse'])) {
                echo "Vous devez choisir une maison";
            }
            ?>
            <br>
            <input type="submit" value="Ajouter">

        </form>

        <form method="post" action=''>
            <h3>Retirer une Piece</h3>
            <?php
            if (!empty($_SESSION['adresse'])) {
                $sql = "SELECT * FROM piece WHERE Maison_idMaison = ( SELECT idMaison FROM maison WHERE maison.Adresse = '" . $_SESSION['adresse'] . "')";
                $result = $conn->query($sql);
                $incrementDropdown = 0;
                echo "<select name='removePiece'>";

                while ($pieces = $result->fetch_assoc()) {
                    $incrementDropdown++;
                    echo "<option value='" . $pieces["idPiece"] . "'>" . $pieces["Nom"] . "</option>";
                }
                echo "</select>";
            } else {
                echo "Vous devez choisir une maison";
            }
            ?>

            <input type="submit" value="Retirer">
        </form>

        <form class="addCapteurType" method="post" action=''>
            <h3>Ajouter un Nouveau Capteur</h3>

            <label for="inputCapteurType" name="type">Type</label>
            <input name="type" type="text" list="capteursExistant"/>
            <datalist id="capteursExistant">
                <?php
                $sql = "SELECT DISTINCT Type FROM capteur ";
                $result = $conn->query($sql);
                while ($capteurs = $result->fetch_assoc()) {
                    echo "<option value='" . $capteurs["Type"] . "'>" . $capteurs["Type"] . "</option>";
                }
                echo "</select>";
                ?>
            </datalist>

            <br>

            <label for="inputCapteurPiece" name="piece">Pièce</label>
            <?php
            if (!empty($_SESSION['adresse'])) {
                $sql = "SELECT * FROM piece WHERE Maison_idMaison = ( SELECT idMaison FROM maison WHERE maison.Adresse = '" . $_SESSION['adresse'] . "')";
                $result = $conn->query($sql);
                $incrementDropdown = 0;
                echo "<select name='Pieces'>";

                while ($pieces = $result->fetch_assoc()) {
                    $incrementDropdown++;
                    echo "<option value='" . $pieces["idPiece"] . "'>" . $pieces["Nom"] . "</option>";
                }
                echo "</select>";
            } else {
                echo "Vous devez choisir une maison";
            }
            ?>

            <br>

            <input type="submit" value="Ajouter">

        </form>

        <form method="post" action=''>
            <h3>Retirer un Capteur</h3>
            <?php
            if (!empty($_SESSION['adresse'])) {

                $sql = "SELECT * FROM capteur";
                $result = $conn->query($sql);
                echo "<select name='removeCapteurPiece'>";

                while ($capteurs = $result->fetch_assoc()) {

                    $sqlPiece = "SELECT * FROM piece WHERE piece.idPiece = " . $capteurs["Piece_idPiece"] . " ";
                    $piece = $conn->query($sqlPiece);
                    $row = $piece->fetch_assoc();
                    $nom = $row["Nom"];

                    echo "<option value='" . $capteurs["idCapteur"] . "'>" . $capteurs["Type"] . " dans " . $nom . " </option>";
                }
                echo "</select>";
            } else {
                echo "Vous devez choisir une maison";
            }
            ?>

            <input type="submit" value="Retirer">
        </form>



    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="views/user/user.js"></script>
<script>

    <?php
    if (isset($adresse)) {
        echo "$('#maisonAffiche').load('afficheMaison.php').fadeIn('slow');";
    }
    ?>

</script>


</body>

</html>