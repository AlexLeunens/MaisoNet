<?php

define("ROOT", __DIR__);

include ROOT.'/models/connect.php';
include ROOT.'/models/secure.php';
include_once ROOT."/controllers/controller.php";

$sql = "DELETE FROM discussion WHERE idDiscussion=". Securite::html($_GET["topicID"]) ." ";

$result = $conn->query($sql);
if(!result){
    echo "Woops ! Erreur lors de la supression du post";
} else {
    echo "Post supprimé avec succès";
    header('Location: index.php?action=see_forum');
    //seeForum();
}
