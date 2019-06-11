<?php
define("ROOT", __DIR__);

include ROOT . '/models/connect.php';
include ROOT . '/models/secure.php';
session_start();

$_SESSION["name"] = "Anonym";
$_SESSION["firstname"] = "Name";


$name = $_SESSION["name"];
$firstname = $_SESSION["firstname"];

$query = "BEGIN WORK;";
$result = $conn->query($query);
if (!$result) {
    echo "Erreur lors de l'envoi du message";
}

// gets the id of the current user
$sql = "SELECT idUtilisateur FROM utilisateur WHERE utilisateur.Nom = '" . $name . "' AND utilisateur.prenom = '" . $firstname . "'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $sender = $row["idUtilisateur"];
}

$sql = "INSERT INTO 
                    contact(idUtilisateur,
                            idReciever,
                          message) 
                VALUES (" . $sender . ",
                        " . $_SESSION["reciever"] . ",
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
}
?>