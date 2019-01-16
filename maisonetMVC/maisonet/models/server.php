<?php

include_once("mailSendingPhpMailer.php");
require_once ROOT."/models/model.php";
session_start();

// Déclaration des Variables
$name = "";
$prenom = "";
$datenaissance = "";
$numtel = "";
$email = "";
$errors = array();
$_SESSION['success'] = "";


//$db = mysqli_connect('localhost', 'root', '', 'dbmaisonet');
//new mysqli('localhost', 'root', '', 'databasemaisonet')
//mysqli_connect('localhost', 'root', '', 'databasemaisonet');

// Inscription
if (isset($_POST['reg_user'])) {

    $name = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $datenaissance = $_POST['datenaissance'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $numtel = $_POST['numtel'];


    if (empty($name)) {
        array_push($errors, "Le nom est obligatoire");
    }
    if (empty($prenom)) {
        array_push($errors, "Le prénom est obligatoire");
    }
    if (empty($email)) {
        array_push($errors, "L'email est obligatoire");
    }
    if (empty($datenaissance)) {
        array_push($errors, "La date de naissance est obligatoire");
    }
    if (empty($password_1)) {
        array_push($errors, "Le mot de passe est obligatoire");
    }
    if (empty($numtel)) {
        array_push($errors, "Le numéro de téléphone est obligatoire");
    }

    if ($password_1 != $password_2) {
        array_push($errors, "Les deux mots de passe ne conviennent pas");
    }


    /*
    if (count($errors) == 0) {
        $password = ($password_1);
        $query = "INSERT INTO `utilisateur` (`idUtilisateur`, `Nom`, `Prénom`, `Date de naissance`, `Email`, `Mot de passe`, `Numéro de téléphone`) VALUES ('', $name, $prenom, $datenaissance, $email, $password, $numtel)";
        $results=mysqli_query($db, $query);
        if (mysqli_num_rows($results==1)){
            $_SESSION['name']=$name;
            $_SESSION['sucess']="Vous êtes connecté.";

            header('location: index.php');


        }else{
            array_push($errors,"Erreur de connexion");
        }

    }*/

    sendConfimMailToAdmin($name, $prenom, $email, $datenaissance, $numtel, 2);
    sendConfirmMail($name, $prenom, $email, $datenaissance, $numtel, 2);

}


// LOGIN
// LOGIN
if (isset($_POST['login_user'])) {
    $email = $_POST['email'];
    //$prenom = $_POST['prenom'];
    $password = $_POST['password'];

    if (empty($email)) {
        array_push($errors, "Le Nom est requis");
    }
    if (empty($password)) {
        array_push($errors, "Le mot de passe est requis");
    }

    if (count($errors) == 0) {

        //$hash = password_hash($password, PASSWORD_DEFAULT);
        $db = dbConnect();

        $query = "SELECT * FROM utilisateur WHERE Email='$email'";    // AND mdp='$hash'";
        $results = $db->prepare($query); //mysqli_query($db, $query);
        $results->execute();
        $results->fetch(PDO::FETCH_ASSOC);
        $hash = $results['MotPasse'];
        if (password_verify($password,$hash)) { //mysqli_num_rows($results) == 1

            $_SESSION['username'] = $name;
            $_SESSION['success'] = "Vous êtes connecté";

            header('location: index.php');
        } else {
            array_push($errors, "Mauvais nom/mot de passe");
        }
    }
}

?>