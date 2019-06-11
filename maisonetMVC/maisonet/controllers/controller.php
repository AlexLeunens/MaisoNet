<?php
/**
 * Created by PhpStorm.
 * User: cwy
 * Date: 06/01/2019
 * Time: 15:19
 */

// view pages

require_once ROOT . "/models/model.php";


function seeHome() {
    require ROOT . "/views/home.php";
}

function seeLogin() {
    require ROOT . "/views/login.php";
}

function seeRegister() {
    require ROOT . "/views/register.php";
}

function seeForum() {
    require ROOT . "/views/forum/forum.php";
}

function seeUserPage() {
    require ROOT . "/views/user/user.php";
}

function seeAdminPage() {
    require ROOT . "/views/admin/admin.php";
}

function seeOurServices() {
    require ROOT . "/views/service/Nos_services.php";
}

function seeAppartServices() {
    require ROOT . "/views/service/services_appart.php";
}

function seeHomeServices() {
    require ROOT . "/views/service/services_maison.php";
}

function seeFAQ() {
    require ROOT . "/views/FAQ/FAQ.php";
}


// gestion des utilisateurs
function addUser() {
    $lastname = htmlspecialchars($_POST["lastname"]);
    $name = htmlspecialchars($_POST["name"]);
    $password = htmlspecialchars($_POST["password"]);
    $email = htmlspecialchars($_POST["email"]);
    $tel = htmlspecialchars($_POST["numtel"]);
    $birthday = htmlspecialchars($_POST["datenaissance"]);
    $type = htmlspecialchars($_POST["type"]); // Wat ?

    insertUser($lastname, $name, $password, $email, $tel, $birthday, $type);

}

function addHouse() {
    $userId = htmlspecialchars($_POST["userId"]);
    $adress = str_replace(" ", "", $_POST['adresse']); //htmlspecialchars($_POST["adresse"]);
    $codePostal = htmlspecialchars($_POST["codePostal"]);
    $pay = htmlspecialchars($_POST["pay"]);

    insertHouse($userId, $adress, $codePostal, $pay);
}

function addPay() {
    $pay = htmlspecialchars($_POST["nomPay"]);

    insertPay($pay);

}


// gestion des sessions

function logout() {
    //session_unset();
    //session_abort();

    session_start();

    $_SESSION = array(); // clear session values
    if (isset($_COOKIE[session_name()])) {  // set cookies outdated if exist
        setcookie(session_name(), '', time() - 1, '/');
    }
    session_destroy();  // destroy session

    header('Location: index.php?action=see_home'); // return to home page

}

function newCat($conn) {
    $catName = $_POST['cat_name'];

    insertNewCat($conn, $catName);
}

function newDiscussion($conn) {
    if (session_status() !== PHP_SESSION_ACTIVE) {

        session_start();

    }

    $topicSubject = $_POST['topic_subject'];
    $topicDescription = $_POST['topic_description'];
    $catId = $_POST['cat_id'];
    $userId = $_SESSION['id'];

    insertNewSubject($conn, $topicSubject, $topicDescription, $catId, $userId);
}



