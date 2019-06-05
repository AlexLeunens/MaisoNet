<?php
//TODO implementer l'ajout de maison, de pièces et de capteurs
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


<div id="Present" class="fonctions">

    <div id="maisonAffiche"></div>

</div>


<div id="Absent" class="fonctions" style="display:none;">
    <p class="piece">Economies</p>
    <div class="panel">
        <div class="block">
            <img class="imagesbutton" src="views/user/Images-utilisateur/temperature.png" alt="temperature"></img>
            <p>Valeur température</p>
        </div>
    </div>

    <p class="piece">Sécurité</p>
    <div class="panel">
        <div class="block">
            <img class="imagesbutton" src="/maisonet/views/user/Images-utilisateur/temperature+.png" alt="temperature"></img>
            <p>Valeur température</p>
        </div>
    </div>
</div>


<li id="addCapteur"><p class="addCapteur">+</p></li>
<div id="ajoutCapteur" class="modal">

    <div class="modal-content">
        <span class="close">&times;</span>

        <form class="addPiece" method="post" action=''>
            <h3>Ajouter une Nouveau Pièce</h3>

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
                echo "<select name='pieces'>";

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

    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>

    var modal = document.getElementById("ajoutCapteur");

    // Get the button that opens the modal
    var btn = document.getElementById("addCapteur");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];


    // When the user clicks on the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


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

    function toggle_visibility(id) {
        var e = document.getElementById(id);
        if (e.style.display == 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
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
        echo "$('#maisonAffiche').load('afficheMaison.php').fadeIn('slow');";
    }
    ?>

</script>


</body>

</html>