<?php
/**
 * Created by PhpStorm.
 * User: cwy
 * Date: 06/01/2019
 * Time: 15:22
 */

include_once ROOT . "/models/mailSendingPhpMailer.php";
require_once ROOT . "\controllers\controller.php";
include_once ROOT . "/models/secure.php";
include ROOT."/models/connect.php";
include_once  ROOT."/models/secure.php";

// Securite::bdd or html

function dbConnect()
{
    try {
        $db = new PDO("mysql:host=localhost;dbname=dbmaisonet;charset=utf8", 'root', '');
        return $db;
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

}


function insertUser($lastname, $name, $password, $email, $tel, $birthday, $type)
{

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $db = dbConnect();

    $result = $db->query("SELECT * FROM utilisateur WHERE Email = '$email'");
    $results = $result->fetch(PDO::FETCH_ASSOC);
    if ($results != null) {
        $count = count($results);
    } else {
        $count = 0;
    }


    if ($count > 0) {
        echo '<script>alert("Cette address mail est déja utilisé, choisissez un autre")</script>';
        header('Location: index.php?action=see_adminPage');

    } else {
        $req = $db->prepare("INSERT INTO utilisateur (Nom, Prenom, MotPasse, NumeroTelephone, Email, DateNaissance, Fonction_idType) VALUES(:nom, :prenom, :mdp, :tel, :email, :birthday, :type)");

        $req->bindParam("nom", $lastname);
        $req->bindParam("prenom", $name);
        $req->bindParam("mdp", $hash);
        $req->bindParam("tel", $tel);
        $req->bindParam("email", $email);
        $req->bindParam("birthday", $birthday);
        $req->bindParam("type", $type);

        $req->execute();


        if ($req) {
            echo '<script>alert("Utilisateur ajouté :)")</script>';
            sendConfirmMailAfterResgist($lastname, $name, $email, $password, $birthday, $tel, 3);
            header('Location: index.php?action=see_adminPage');
        } else {
            echo '<script>alert("Une erreur est survenu, réessayez :(")</script>';
            header('Location: index.php?action=see_adminPage');
        }

        $req->closeCursor();

    }
}

function userConnect($email, $password)
{
    $db = dbConnect();

    session_start();

    $req = $db->prepare("SELECT * FROM utilisateur WHERE Email = :email");
    $req->bindParam("email", $email);
    $req->execute();

    if ($req) {
        $result = $req->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $result['MotPasse'])) {   //$password == $result['password']) {
            echo "<script>alert('connexion réussi !')</script>";

            $_SESSION['id'] = $result['idUtilisateur'];
            $_SESSION['name'] = $result['Nom'];
            $_SESSION['firstname'] = $result['Prenom'];
            $_SESSION['email'] = $result['Email'];
            $_SESSION['tel'] = $result['NumeroTelephone'];
            $_SESSION['birthday'] = $result['DateNaissance'];
            $_SESSION['type'] = $result['Fonction_idType'];

            if ($_SESSION['type'] == 3) {
                //seeUserPage();
                header('Location: index.php?action=see_userPage');
            } else {
                //seeAdminPage();
                header('Location: index.php?action=see_adminPage');
            }

        } else {
            echo "<script>alert('utilisateur introuvable')</script>";
            header('Location: index.php?action=see_login');
        }


    } else {
        echo "<script>alert('utilisateur introuvable')</script>";
        header('Location: index.php?action=see_login');
    }


    $req->closeCursor();


}

function userRegisterRequest($lastname, $name, $email, $birthday, $tel)
{

    sendConfimMailToAdmin($lastname, $name, $email, $birthday, $tel, 3);
    sendConfirmMail($lastname, $name, $email, $birthday, $tel, 3);

    echo "<script>alert('Votre demande a été envoyé. Si vous ne recevez pas de email de confirmation, veuillez nous contacter')</script>";
    header('Location: index.php?action=see_register');

}


function insertHouse($userId, $adresse, $codePostal, $pay)
{


    $db = dbConnect();


    $req = $db->prepare("INSERT INTO maison (Adresse, CodePostal, Pays_idPays, Utilisateur_idUtilisateur) VALUES( :adress, :codePostal, :pay, :userId)");

    $req->bindParam("adress", $adresse);
    $req->bindParam("codePostal", $codePostal);
    $req->bindParam("pay", $pay);
    $req->bindParam("userId", $userId);

    $req->execute();


    if ($req) {
        echo '<script>alert("Maison ajouté :)")</script>';
        header('Location: index.php?action=see_adminPage');
    } else {
        echo '<script>alert("Une erreur est survenu, réessayez :(")</script>';
        header('Location: index.php?action=see_adminPage');
    }

    $req->closeCursor();


}


function insertNewCat($conn,$catName){

    $query = "BEGIN WORK;";
    $result = $conn->query($query);
    if (!$result) {
        //Damn! the query failed, quit
        echo 'An error occurred while preparing the operation. Please try again later.';
    }

    $sql = "INSERT INTO categorie(Nom) VALUES('" . Securite::bdd($conn, $catName). "')";

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
        //header("location: {$_SERVER['PHP_SELF']}");
        header('Location: index.php?action=see_forum');
    }

}

function insertNewSubject($conn,$topicSubject,$topicDescription,$catId,$userId){

    $query = "BEGIN WORK;";
    $result = $conn->query($query);
    if (!$result) {

        echo 'An error occurred while preparing the operation. Please try again later.';
    }

    $sql = "INSERT INTO
                        discussion(Sujet,
                               Texte,
                               Categorie_idCategorie,
                               Utilisateur_idUtilisateur)
                   VALUES('" . Securite::bdd($conn, $topicSubject) . "',
                   '" . Securite::bdd($conn, $topicDescription) . "',
                               " . Securite::bdd($conn, $catId) . ",
                               ".Securite::bdd($conn, $userId).")";

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
        //header("location: {$_SERVER['PHP_SELF']}");
        header('Location: index.php?action=see_forum');
    }
}

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

function afficheMaison($conn,$name,$firstname,$adresse){


// Get user id
    $sql = "SELECT idUtilisateur FROM utilisateur WHERE utilisateur.Nom = '" . $name . "' AND utilisateur.prenom = '" . $firstname . "'";
    $result = $conn->query($sql);


    while ($row = $result->fetch_assoc()) {
        $idUser = $row["idUtilisateur"];
    }

// Get maison id
    $sql = "SELECT idMaison FROM maison WHERE Utilisateur_idUtilisateur = " . $idUser . " AND Adresse = '" . $adresse . "' ";
    $result = $conn->query($sql);
    echo $sql;

    if (mysqli_num_rows($result) == 0) {
        echo " <h2> Vous n'avez pas saisi une bonne adresse </h2>";
    } else {

        while ($row = $result->fetch_assoc()) {
            $maison = $row["idMaison"];
        }

        // Get pieces
        $sql = " SELECT * FROM piece WHERE Maison_idMaison = " . $maison . " ";
        $result = $conn->query($sql);

        // Goes through each piece
        while ($rowPiece = $result->fetch_assoc()) { // piece

            echo "<p class='piece'> " . $rowPiece["Nom"] . " </p>";
            echo "<div class='panel'>";

            $sqlCapteur = " SELECT * FROM capteur WHERE Piece_idPiece = " . $rowPiece["idPiece"] . " ";
            $resultCapteur = $conn->query($sqlCapteur);

            // Goes through each capteur
            while ($rowCapteur = $resultCapteur->fetch_assoc()) {


                echo "<div class=bloc><a href='#masque'>";

                // TODO change image name
                echo "<img class='imagestemperature' src='Images-utilisateur/" . $rowCapteur["Type"] . ".png' alt='" . $rowCapteur["Type"] . "'></img>";
                echo "<p class=sstitre>Votre " . $rowCapteur["Type"] . "</p></a>";

                echo "</div>"; // div bloc

            }

            echo "</div> \n"; // div panel

        }

    }

}

//infomaisonet@gmail.com

//　　　　　　　　　　　　　　　　　　 　 _, ._　　　　　　　　　　　　　 '　　' , 　w
//　　　　　　　　　　　　　　　　　 　 （・ω・　）　　　　　　　　　　　　　彡''
//　　　　　　　　　　 ||　　　 　 ⊂⊃⊂ 　　 ）/　＿/二二二 l　彡 w
//　　　　 ＿＿＿＿| |＿＿/__// /￣＿＿）／ ／ ＿＿＿l_ '_　' , 　w
//　　　　 |0≡０|　＝＝＝　　|/（_＿）====/　/ ／＼／ 　　＼
//　 　 　　|IIIIIIII|　　　　　　 └─┘　　　　￣ /,／/　/.￣ヽ.　l　　㌦ﾙﾙﾙ
//　　 　 　|IIIIIIII| //￣ヽ＿＿＿＿＿＿＿＿_|＼ |　 l 　 　 l　 | '_　' ,
//　　 　 　l l￣￣ｌ l　　　l.　　　　　　　　　　　　l ノ l　 ヽ,＿,ﾉ　,l
//　　　 　 ヽヽ 　 ヽヽ__ノ　　　　　　　　　 　　　ヽ,,　＼,＿＿ ノ
//ｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗｗ ｗｗｗ ｗｗｗ 　ｗｗｗ ｗｗｗ
