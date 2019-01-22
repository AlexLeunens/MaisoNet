<?php
include 'connect.php';
include 'secure.php';

// idUtilisateur = sent to
// sender = sent by

if (!empty($_GET)) {

    session_start();
    $_SESSION["idContact"] = $_GET['idContact'];

    $sql = "SELECT idUtilisateur FROM utilisateur WHERE utilisateur.Nom = '" . Securite::bdd($conn, $_GET['nom']) . "'
        AND utilisateur.prenom = '" . Securite::bdd($conn, $_GET['prenom']) . "'";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $sender = $row["idUtilisateur"];
    }

    // select message sent to idUtilisateur and sent by sender, or sent to sender (current user) by idUtilisateur
    $sql = "SELECT * FROM contact WHERE ( contact.idUtilisateur = " . Securite::bdd($conn, $_GET['idContact']) . " AND contact.idReciever = '" . $sender . "' )
        OR ( contact.idUtilisateur = " . $sender . " AND contact.idReciever = '" . Securite::bdd($conn, $_GET['idContact']) . "' ) ORDER BY idContact";
    $result = $conn->query($sql);

    while ($rowMessage = $result->fetch_assoc()) {

        // if the current user did not sent the message
        if ($rowMessage["idUtilisateur"] === Securite::html($_GET['idContact'])) {
            echo "<div id=messageContainer style='display: flex; justify-content: flex-end' >";
            echo "<p style='background-color: rgb(0, 132, 254); color: white'>" . $rowMessage["message"] . "</p>";
            echo "</div>";
        } else {
            echo "<div id=messageContainer style='display: flex; justify-content: flex-start; '>";
            echo "<p style='background-color: rgb(220, 220, 220); color: black'>" . $rowMessage["message"] . "</p>";
            echo "</div>";
        }

    }

}


?>
