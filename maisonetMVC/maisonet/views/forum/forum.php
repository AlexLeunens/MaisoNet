<!doctype html>
<html lang="fr">

<?php

include ROOT.'/models/connect.php';
include_once ROOT.'/views/template/headerForums.php';
include_once ROOT.'/models/secure.php';
?>


<?php
session_start();
$name = $_SESSION["name"];
$firstname = $_SESSION["firstname"];
echo $name;
echo $firstname;
//this tries to create a new topic in the database
// check if something has been posted

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $query = "BEGIN WORK;";
    $result = $conn->query($query);
    if (!$result) {
        //Damn! the query failed, quit
        echo 'An error occurred while preparing the operation. Please try again later.';
    }

    // checks which form has been submited
    if(isset($_POST["newSubject"])){
        $sql = "INSERT INTO
                        discussion(Sujet,
                               Texte,
                               Categorie_idCategorie,
                               Utilisateur_idUtilisateur)
                   VALUES('" . Securite::bdd($conn, $_POST['topic_subject']) . "',
                   '" . Securite::bdd($conn, $_POST['topic_description']) . "',
                               " . Securite::bdd($conn, $_POST['cat_id']) . ",
                               1)";

    } else if(isset($_POST["newCat"])){
        $sql = "INSERT INTO
                        categorie(Nom)
                   VALUES('" . Securite::bdd($conn, $_POST['cat_name']) . "')";
    }

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
        header("location: {$_SERVER['PHP_SELF']}");
    }

}
?>

<?php


if(isset($_SESSION['name']) && isset($_SESSION['firstname'])) {
    $sql = "SELECT idUtilisateur from utilisateur WHERE nom = '".Securite::bdd($conn, $_SESSION['name'])."'
                                            AND prenom = '".Securite::bdd($conn, $_SESSION['firstname'])."' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $idUser = $row["idUtilisateur"];
    }
} else {
    $idUser = 1;
}


global $isAdmin;

//$_SESSION['type']
if($_SESSION['type'] == 1){
    $isAdmin = true;
}else{
    $isAdmin = false;
}


$sql = "SELECT idUtilisateur from utilisateur WHERE nom = '".Securite::bdd($conn, $name)."'
                                            AND prenom = '".Securite::bdd($conn, $firstname)."' ";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $idUser = $row["idUtilisateur"];
}

/*$sql = "SELECT type from fonction WHERE Utilisateur_idUtilisateur = ".$idUser." ";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo $row["type"];
    if($row["type"] === "Administrateur" ) {
        $isAdmin = true;
    }
}*/

if ($isAdmin == true){
    echo "Admin";
} else {
    echo "Not admnin";
}
echo $isAdmin;
$GLOBALS['isAdmin'] = $isAdmin;

?>

<div id="menu">
    <div id="onglets">

        <h2>Forums</h2>

        <?php
        if ($isAdmin == true){
         echo " <button class=\"newCatBtn\" onclick=\"openFormCat() \">Ajouter Catégorie</button> " ;
        }
        ?>

        <div class="form-popup" id="newCat">
            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" class="form-container">
                <h1>Création de Catégorie</h1>

                <label for="text"><b>Nom de la catégorie</b></label>
                <input type="text" placeholder="Nom" name="cat_name" required>

                <div class="btnWrapper">
                    <button type="submit" class="btn" name="newCat">Créer une nouvelle Catégorie</button>
                    <button type="button" class="btn cancel" onclick="closeFormCat()">Annuler</button>
                </div>

            </form>
        </div>

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
    //TODO : if pour les admins
    //TODO : bouton pour ajouter une catégorie

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
    function displayTopics($incrementTopics, $conn, $rowCat) {
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

            //TODO create deleteTopic.php to delete a topic

            $isAdmin = $GLOBALS['isAdmin'];
            if ($isAdmin == true){
                echo "<form method='post' action=' deleteTopic.php?topicID=" . $row["idDiscussion"] . " '>";
            }

            echo "<button type='submit' name='delTopic' id='delTopic'> x </button>\n";
            echo "</form>";

            echo "<a href=topic.php?id=" . $row["idDiscussion"] . ">";
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
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" class="form-container">
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
                <button type="submit" class="btn" name="newSubject">Créer un Sujet</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
            </div>

        </form>
    </div>

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

    function openFormCat() {
        document.getElementById("newCat").style.display = "block";
    }

    function closeFormCat() {
        document.getElementById("newCat").style.display = "none";
    }

</script>


</body>
</html>
