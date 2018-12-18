<!doctype html>
<html lang="fr">


<?php
include 'connect.php';
include 'header.php';
?>

<div id="menu">
    <div id="onglets">

        <h2>Forums</h2>
        <ul id="myMenu">
            <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
            <li><a id="defaultOpen" href="javascript:openPage('Accueil', this)">Accueil</a></li>
            <?php

            //$sql = "SELECT * FROM categories";
            $sql = "SELECT * FROM categorie";
            $result = $conn->query($sql);
            // while there are still rows to be displayed
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "<a href='javascript:openPage(\"" . $row["Nom"] . "\", this)'>" . $row["Nom"];
                echo "</a>";
                echo "</li>";
                echo "\n";
            }
            ?>
        </ul>
    </div>
    <!-- INSIDE CATEGORIES -->
    <?php
    $sql = "SELECT * FROM categorie";
    $result = $conn->query($sql);

    $incrementTopics = 0;
    // while there are still rows to be displayed
    while ($rowCat = $result->fetch_assoc()) {
        echo "<div id=\"" . $rowCat["Nom"] . "\" class=\"Elements\">";
        $incrementTopics++;
        displayTopics($incrementTopics, $conn, $rowCat);
        echo "<button class=\"newSujetBtn\" onclick=\"openForm()\">Nouveau Sujet</button>";
        echo "</div>";
        echo "\n";
    }
    ?>
    <!-- END INSIDE CATEGORIES -->

    <div id="Accueil" class="Elements">
        <h2>Utilisation</h2>
    </div>

    <?php
    function displayTopics($incrementTopics, $conn, $rowCat)
    {
        echo "<h2>" . $rowCat["Nom"] . "</h2>";
        $sql = "SELECT * FROM discussion WHERE Categorie_idCategorie = ' " . $incrementTopics . " ' ";
        $result = $conn->query($sql);
        // while there are still rows to be displayed
        while ($row = $result->fetch_assoc()) {
            echo "\n";
            echo "<div id=\"" . $row["Sujet"] . "\" class=\"divTable post\">\n";
            echo "<div class=\"divTableHeading\">\n";
            echo "<div class=\"divTableRow\">\n";

            echo "<div class=\"divTableHead\">";
            echo "<a href=topic.php?id=" . $row["idDiscussion"].">";
            echo $row["Sujet"];
            echo "</a>";

            echo "</div>\n";

            echo "</div>\n";
            echo "</div>\n";
            echo " <div class=\"divTableBody\">\n";
            echo "<div class=\"divTableRow\">\n";
            echo "<div class=\"divTableCell\">" . $row["Texte"] . "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
        }
    }

    ?>

    <div class="form-popup" id="myForm">
        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" class="form-container">
            <h1>Création de Sujet</h1>

            <label for="text"><b>Sujet</b></label>
            <input type="text" placeholder="Nom du Sujet" name="topic_subject" required>

            <label for="text"><b>Description</b></label>
            <input type="text" placeholder="Description (255 caractères)" name="topic_description" required>

            <label for="text"><b>Poster dans :</b></label>
            <?php
            $sql = "SELECT * FROM categorie";
            $result = $conn->query($sql);
            $incrementDropdown = 0;

            echo "<select name='cat_id'>";
            while ($formCat = $result->fetch_assoc()) {
                $incrementDropdown++;
                echo "<option value='" . $incrementDropdown . "'>" . $formCat["Nom"] . "</option>";
            }
            echo "</select>";
            ?>
            <div class="btnWrapper">
                <button type="submit" class="btn">Créer un Sujet</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
            </div>

        </form>
    </div>

    <?php //this tries to create a new topic in the database
    // check if something has been posted
    //if(isset($_POST['submit']))
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $query = "BEGIN WORK;";
        $result = $conn->query($query);
        if (!$result) {
            //Damn! the query failed, quit
            echo 'An error occurred while creating your topic. Please try again later.';
        }

        $sql = "INSERT INTO
                        discussion(Sujet,
                               Texte,
                               Categorie_idCategorie,
                               Utilisateur_idUtilisateur)
                   VALUES('" . mysqli_real_escape_string($conn, $_POST['topic_subject']) . "',
                   '" . mysqli_real_escape_string($conn, $_POST['topic_description']) . "',
                               " . mysqli_real_escape_string($conn, $_POST['cat_id']) . ",
                               1)";
//TODO update utilisateur
        $result = $conn->query($sql);
        if (!$result) {
            //something went wrong, display the error
            echo 'An error occured while inserting your data. Please try again later.';
            echo mysqli_error($conn);
            echo $sql;
            $sql = "ROLLBACK;";
            $result = $conn->query($query);
        } else {
            $sql = "COMMIT;";
            $result = $conn->query($sql);

            //after a lot of work, the query succeeded!
            echo 'You have successfully created your new topic.';
            header("location: {$_SERVER['PHP_SELF']}");
        }

    }


    ?>

</div>

<script>
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

</script>


</body>