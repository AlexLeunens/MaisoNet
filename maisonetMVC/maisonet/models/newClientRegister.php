<?php
$mysqli = mysqli_connect('localhost', 'root', '', 'maisonet_test');

if (!$mysqli) {
    die('<p>Connexion impossible : '.$mysqli->connect_error.'</p>');
}

//$action = $_GET['action'];
$lastName = $_POST['lastname'];
$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$tel = $_POST['tel'];

//$data['password'] = md5($password);

$sql = "insert into utilisateur(Nom,Prenom,MotPasse,NumeroTelephone,Email,DateNaissance,Fonction_Type)values('%s','%s','%s','%s','%s','%s','%s')";
$formatted = sprintf($sql,$lastName,$name,$password,$tel,$email,$birthday,"user");
$result = mysqli_query($mysqli,$formatted);
echo $formatted;
echo $result? "client ajouté":"Erreur lors de l'inscription";

//header('location: usermain1.php');