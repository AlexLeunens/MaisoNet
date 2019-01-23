<?php
include ROOT.'/models/connect.php';
include ROOT.'/models/secure.php';

echo "<form class='dossier' method='post' action=''>";
echo "Adresse client : <input type=\"text\" name=\"adresse\">";
echo "<input align=\"right\" type=\"submit\" name=\"getMaison\" value=\"Entrée\">";
echo "</form>";

$name = Securite::bdd($conn, $_GET['nom']);
$firstname = Securite::bdd($conn, $_GET['prenom']);

//$name = $_SESSION["name"];
//$firstname = $_SESSION["firstname"];
$adresse = Securite::bdd($conn, $_GET["Adresse"]);

// Get user id
$sql = "SELECT idUtilisateur FROM utilisateur WHERE utilisateur.Nom = '" . $name . "' AND utilisateur.prenom = '" . $firstname . "'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $idUser = $row["idUtilisateur"];
}

// Get maison id
$sql = "SELECT idMaison FROM maison WHERE Utilisateur_idUtilisateur = " . $idUser . " AND Adresse = '" . $adresse . "' ";
$result = $conn->query($sql);

if (mysqli_num_rows($result) == 0) {
    echo " <h2> Vous n'avez pas saisi une bonne adresse </h2>";
} else {

    while ($row = $result->fetch_assoc()) {
        $maison = $row["idMaison"];
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


            echo "<div class=bloc><a href='#masque'>";

            // TODO change image name
            echo "<img class='imagestemperature' src='Images-utilisateur/" . $rowCapteur["Type"] . ".png' alt='" . $rowCapteur["Type"] . "'></img>";
            echo "<p class=sstitre>Votre " . $rowCapteur["Type"] . "</p></a>";

            echo "</div>"; // div bloc

        }

        echo "</div> \n"; // div panel
        //echo "<a></a>"

    }

}


?>
