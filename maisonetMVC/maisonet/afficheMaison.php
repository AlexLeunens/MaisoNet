<?php
define("ROOT", __DIR__);
include ROOT . '/models/connect.php';
include ROOT . '/models/secure.php';

echo "<form class='dossier' method='post' action=''>";
echo "Adresse client : <input type=\"text\" name=\"adresse\">";
echo "<input align=\"right\" type=\"submit\" name=\"getMaison\" value=\"Entrée\">";
echo "</form>";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();

}

//DEBUG
$_SESSION["name"] = "Anonym";
$_SESSION["firstname"] = "Name";
$_SESSION['type'] = 2;


$name = $_SESSION["name"];
$firstname = $_SESSION["firstname"];
$adresse = $_SESSION["adresse"];
$userType = $_SESSION['type'];

// Get user id
$sql = "SELECT idUtilisateur FROM utilisateur WHERE utilisateur.Nom = '" . $name . "' AND utilisateur.prenom = '" . $firstname . "'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $idUser = $row["idUtilisateur"];
}


// Get maison id
if ($userType == 3) {

    $sql = "SELECT idMaison FROM maison WHERE Utilisateur_idUtilisateur = " . $idUser . " AND Adresse = '" . $adresse . "' ";

} else {

    $sql = "SELECT idMaison FROM maison WHERE Adresse = '" . $adresse . "' ";
}
$result = $conn->query($sql);
//echo $sql;

if (mysqli_num_rows($result) == 0) {

    echo " <h2> Vous n'avez pas saisi une bonne adresse </h2>";

} else {

    while ($row = $result->fetch_assoc()) {
        $maison = $row["idMaison"];
        //echo $maison;
    }

    // Get pieces
    $sql = " SELECT * FROM piece WHERE Maison_idMaison = " . $maison . " ";
    $result = $conn->query($sql);

    // Goes through each piece
    while ($rowPiece = $result->fetch_assoc()) { // piece

        echo "<p class='piece'> " . $rowPiece["Nom"] . " </p>";

        echo "<div class='panel'>";

        $sqlCapteur = " SELECT * FROM capteur WHERE Piece_idPiece = " . $rowPiece["idPiece"] . " ";
        $resultCapteur = $conn->query($sqlCapteur);

        // Goes through each capteur
        while ($rowCapteur = $resultCapteur->fetch_assoc()) {

            // TODO fix this masque mess
            echo "<div class=bloc>";
            // echo "<a href='#masque'>";



            echo "<div class='affichageCapteurs' id='capteur" . $rowCapteur["idCapteur"] . "' style='display:none'>";
            echo "<h2>Votre Capteur:</h2>";

            echo "<form>";
            echo "<input type='button1' value=' - ' onClick='javascript:this.form.champ.value--;'>";
            echo "<input type='text1' name='champ' value='0'>";
            echo "<input type='button1' value=' + ' onClick='javascript:this.form.champ.value++;'>";
            echo "</form>";

            echo "</div>";




            echo "<img onclick=\"toggle_visibility('capteur" . $rowCapteur["idCapteur"] . "');\" class='imagestemperature' src='views/admin/Images-utilisateur/" . $rowCapteur["Type"] . ".png' alt='" . $rowCapteur["Type"] . "'></img>";
            echo "<p class=sstitre>Votre " . $rowCapteur["Type"] . "</p>";
            // echo "</a>";

            echo "</div>"; // div bloc

        }

        echo "<a class='displayGraph'  href='views/graphTemperature/grapheTemperature.php' target='_blank' >Ouvrir le graphe de la température dans une nouvelle fenêtre</a>";

        echo "</div> \n"; // div panel


    }

}


?>
