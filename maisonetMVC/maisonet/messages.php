<?php
define("ROOT", __DIR__);

include ROOT . '/models/connect.php';
include ROOT . '/models/secure.php';

// idUtilisateur = sent to
// sender = sent by
session_start();

$_SESSION["name"] = "Anonym";
$_SESSION["firstname"] = "Name";


$name = $_SESSION["name"];
$firstname = $_SESSION["firstname"];

if (!empty($_GET)) {

    echo "<div id='Messages'>";

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

    echo "</div>";
}


?>

<div id="chatbox">
    <form method='post' id='message' name="message" ;>
        <input name="user_message" type="text" id="usermsg" required/>
        <input name="submitmsg" id="submitmsg" type="submit" value="Send"/>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    $(document).on("click", "#submitmsg", function () {
        alert("FUCK");

        var postData = $(this).serializeArray();
        $.ajax(
            {
                url: "sendMessage.php?idContact=1",
                type: "POST",
                data: postData,
                success: function (data, textStatus, jqXHR) {
                    //data: return data from server
                    alert("yes");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //if fails
                    alert("fail");
                }
            });
        e.preventDefault(); //STOP default action
        e.unbind(); //unbind. to stop multiple form submit.
    });

    clearTimeout(timeout);
    var timeout = setTimeout(function () {
        <?php
        echo "$('#Messages').load('messages.php?idContact=" . Securite::bdd($conn, $_GET['idContact']) . "&nom=" . Securite::bdd($conn, $_GET['nom']) . "&prenom=" . Securite::bdd($conn, $_GET['prenom']) . "').fadeIn('slow');";
        ?>
    }, 5000);
</script>



