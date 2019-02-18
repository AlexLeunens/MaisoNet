<?php
define("ROOT", __DIR__);

include ROOT . '/models/connect.php';
include ROOT . '/models/secure.php';

// idUtilisateur = current user

session_start();

$_SESSION["name"] = "Anonym";
$_SESSION["firstname"] = "Name";


$name = $_SESSION["name"];
$firstname = $_SESSION["firstname"];

if (!empty($_GET)) {

    echo "<div id='Messages'>";


    //get current user
    $sql = "SELECT idUtilisateur FROM utilisateur WHERE utilisateur.Nom = '" . $name . "'
        AND utilisateur.prenom = '" . $firstname . "'";

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $sender = $row["idUtilisateur"];
    }

    //get reciever
    $sql = "SELECT idUtilisateur FROM utilisateur WHERE utilisateur.Nom = '" . Securite::bdd($conn, $_GET['nom']) . "'
        AND utilisateur.prenom = '" . Securite::bdd($conn, $_GET['prenom']) . "'";

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $reciever = $row["idUtilisateur"];
    }

    $_SESSION["reciever"] = $reciever;


    // select message sent to reciever by sender, or sent to sender (current user) by reciever
    $sql = "SELECT * FROM contact WHERE ( contact.idUtilisateur = " . $sender . " AND contact.idReciever = '" . $reciever . "' )
        OR ( contact.idUtilisateur = " . $reciever . " AND contact.idReciever = '" . $sender . "' ) ORDER BY idContact";
    $result = $conn->query($sql);

    while ($rowMessage = $result->fetch_assoc()) {

        // if the current user sent the message blue
        if ($rowMessage["idUtilisateur"] === $sender) {
            echo "<div id=messageContainer style='display: flex; justify-content: flex-end' >";
            echo "<p style='background-color: rgb(0, 132, 254); color: white'>" . $rowMessage["message"] . "</p>";
            echo "</div>";
        } else {
            echo "<div id=messageContainer style='display: flex; justify-content: flex-start; '>";
            echo "<p style='background-color: rgb(220, 220, 220); color: black'>" . $rowMessage["message"] . "</p>";
            echo "</div>";
        }

    }

    echo "</div>";

}

?>

<script>

    clearTimeout(timeout);
    var timeout = setTimeout(function () {
        <?php
        echo "$('#Messages').load('messages.php?nom=" . Securite::bdd($conn, $_GET['nom']) . "&prenom=" . Securite::bdd($conn, $_GET['prenom']) . "').fadeIn('slow');";
        ?>
    }, 5000);
</script>



