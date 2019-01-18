<?php
/**
 * Created by PhpStorm.
 * User: cwy
 * Date: 06/01/2019
 * Time: 15:19
 */


require_once ROOT . "/models/model.php";


function seeHome()
{
    require ROOT . "/views/home.php";
}

function seeLogin()
{
    require ROOT . "/views/login.php";
}

function seeRegister()
{
    require ROOT . "/views/register.php";
}

function seeForum()
{
    require ROOT."/views/forum/forum.php";
}

function seeUserPage()
{
    require ROOT."/views/user/user.php";
}

function seeAdminPage()
{
    require  ROOT."/views/admin/admin.php";
}


// ces fonctions ne sont pas fini !!!
function addUser()
{
    $lastname = htmlspecialchars($_POST["lastname"]);
    $name = htmlspecialchars($_POST["name"]);
    $password = htmlspecialchars($_POST["password"]);
    $email = htmlspecialchars($_POST["email"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $birthday = htmlspecialchars($_POST["birthday"]);
    $type = htmlspecialchars($_POST["type"]);

    insertUser($lastname, $name, $password, $email, $tel, $birthday, $type);
    
}

function registerRequest(){

    $lastname = $_POST['nom'];
    $name = $_POST['prenom'];
    $email = $_POST['email'];
    $birthday = $_POST['datenaissance'];
    //$password_1 = $_POST['password_1'];
    //$password_2 = $_POST['password_2'];
    $tel = $_POST['numtel'];

    userRegisterRequest($lastname,$name,$email,$birthday,$tel);



}

function login()
{
    if ($_POST['email'] && $_POST['password']) {
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password']; //htmlspecialchars($_POST['password']);

        userConnect($email, $password);
        
    }else{
        echo 'les cases ne sont pas tous remplient';
    }

}

function logout()
{
    //session_unset();
    //session_abort();

    session_start();

    $_SESSION = array(); // clear session values
    if(isset($_COOKIE[session_name()])){  // set cookies outdated if exist
        setcookie(session_name(),'',time()-1,'/');
    }
    session_destroy();  // destroy session

    require ROOT . "/views/home.php"; // return to home page

}


