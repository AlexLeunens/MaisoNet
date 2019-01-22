<!doctype html>
<html lang="fr">
<?php
include 'connect.php';
include 'headerForums.php';
include 'secure.php';
?>


<div id="menu">
    <div id="onglets">
        <?php
        $sql = "SELECT * FROM discussion WHERE discussion.idDiscussion = " . Securite::bdd($conn, $_GET['id']);
        $result = $conn->query($sql);

        while ($rowTopic = $result->fetch_assoc()) {
            echo "<h2>" . $rowTopic["Sujet"] . "</h2>";
        }
        ?>
    </div>


    <?php
    $sql = "SELECT * FROM discussion WHERE discussion.idDiscussion = " .  Securite::bdd($conn, $_GET['id']);
    $result = $conn->query($sql);

    while ($rowTopic = $result->fetch_assoc()) {

        echo "\n";
        echo "<div id=\"" . $rowTopic["Sujet"] . "\" class=\"divTable post\">\n";
        echo "<div class=\"divTableHeading\">\n";
        echo "<div class=\"divTableRow\">\n";

        echo "<div class=\"divTableHead\">";
        echo "<a href=topic.php?id=" . $rowTopic["idDiscussion"].">";
        echo $rowTopic["Sujet"];
        echo "</a>";

        echo "</div>\n";

        echo "</div>\n";
        echo "</div>\n";
        echo " <div class=\"divTableBody\">\n";
        echo "<div class=\"divTableRow\">\n";
        echo "<div class=\"divTableCell\">" . $rowTopic["Texte"] . "</div>\n";
        echo "</div>\n";
        echo "</div>\n";
        echo "</div>\n";

        displayPosts($conn, $rowTopic);
        echo "<button class=\"newSujetBtn\" onclick=\"openForm()\">Répondre au Topic</button>";
        echo "<a href=\"forum.php\" class=\"goBack\">Retour au Forum</a>";
        echo "</div>";
        echo "\n";
    }

    function displayPosts($conn, $rowTopic)
    {
        $sql = "SELECT * FROM message WHERE message.Discussion_idDiscussion = " . Securite::bdd($conn, $_GET['id']);
        $result = $conn->query($sql);

        // while there are still rows to be displayed
        while ($row = $result->fetch_assoc()) {
            echo "\n";
            echo "<div id=\"" . $row["Discussion_idDiscussion"] . "\" class=\"divTable post\">\n";

            echo " <div class=\"divTableBody\">\n";
            echo "<div class=\"divTableRow\">\n";
            echo "<div class=\"divTableCell\">" . $row["Message"] . "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
        }
    }

    ?>

    <div class="form-topic" id="myForm">
        <form method="post" action="" class="form-container">
            <h1>Ajouter une réponse</h1>

            <textarea placeholder="Description (255 caractères)" name="reply_content" required></textarea>

            <div class="btnWrapper">
                <button type="submit" class="btn">Répondre au Sujet</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
            </div>

        </form>
    </div>

</div>




<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "BEGIN WORK;";
    $result = $conn->query($query);
    if (!$result) {
        //Damn! the query failed, quit
        echo 'An error occurred while creating your topic. Please try again later.';
    }

    $sql = "INSERT INTO 
                    message(Message,
                          Utilisateur,
                          Discussion_idDiscussion,
                          Utilisateur_idUtilisateur) 
                VALUES ('" .  Securite::html($_POST['reply_content']) . "',
                        'TestUser',
                        " .  Securite::bdd($conn, $_GET['id']) . ",
                        1   )";

    $result = $conn->query($sql);
    if (!$result) {
        //something went wrong, display the error
        echo 'An error occured while inserting your data. Please try again later.';
        echo mysqli_error($conn);
        $sql = "ROLLBACK;";
        $result = $conn->query($query);
    } else {
        $sql = "COMMIT;";
        $result = $conn->query($sql);

        //after a lot of work, the query succeeded!
        echo 'You have successfully created your new topic.';
        unset($_POST);
        //header("topic.php?id='" . $_GET['id'] . "' ");
        header('Location: '. $_SERVER['PHP_SELF']."?id=" . Securite::html($_GET['id']));
    }
}
?>

<script>

    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

</script>

