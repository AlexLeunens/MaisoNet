<?php
include 'connect.php';

//TODO récupérer les messages provenant d'un utilisateur
if (!empty($_GET)) {
    $sql = "SELECT * FROM contact WHERE contact.idUtilisateur = " . mysqli_real_escape_string($conn, $_GET['idContact']);
    //$sql = "SELECT * FROM contact WHERE contact.idUtilisateur = 1";
    $result = $conn->query($sql);

    while ($rowMessage = $result->fetch_assoc()) {
        echo "<p>" . $rowMessage["message"] . "</p>";
    }

}
?>
