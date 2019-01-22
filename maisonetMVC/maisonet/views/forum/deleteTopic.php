<?php
include 'connect.php';
include 'secure.php';

$sql = "DELETE FROM discussion WHERE idDiscussion=". Securite::html($_GET["topicID"]) ." ";

$result = $conn->query($sql);
if(!result){
    echo "Woops ! Erreur lors de la supression du post";
} else {
    echo "Post supprimé avec succès";
    header('Location: forum.php');
}
