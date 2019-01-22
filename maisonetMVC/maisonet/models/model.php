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
        seeAdminPage();

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
            seeAdminPage();
        } else {
            echo '<script>alert("Une erreur est survenu, réessayez :(")</script>';
            seeAdminPage();
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
                seeUserPage();
            } else {
                seeAdminPage();
            }

        } else {
            echo "<script>alert('utilisateur introuvable')</script>";
            seeLogin();
        }


    } else {
        echo "<script>alert('utilisateur introuvable')</script>";
        seeLogin();
    }


    $req->closeCursor();


}

function userRegisterRequest($lastname, $name, $email, $birthday, $tel)
{

    sendConfimMailToAdmin($lastname, $name, $email, $birthday, $tel, 3);
    sendConfirmMail($lastname, $name, $email, $birthday, $tel, 3);

    echo "<script>alert('Votre demande a été envoyé. Si vous ne recevez pas de email de confirmation, veuillez nous contacter')</script>";
    seeRegister();

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
        seeAdminPage();
    } else {
        echo '<script>alert("Une erreur est survenu, réessayez :(")</script>';
        seeAdminPage();
    }

    $req->closeCursor();


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
