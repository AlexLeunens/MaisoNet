<!DOCTYPE HTML>

<?php
    session_start();
    $username= "jullian";
    $password= "levy";

   

    if (isset($_POST['username'])&& isset($_POST['password'])) {
        if ($_POST['username']==$username && $_POST['password']==$password){
            $_SESSION['loggedin']=true;
            header("Location: successLogin.php");
        }
        else{
            echo "identifiants incorrect";
        }

    }
?>


<html>
    <body>
        <form method="post" action="index.php">
            Username:<br/>
            <input type="text" name="username"><br/>
            Password:<br/>
            <input type="text" name="password"><br/>
            <input type="submit" value="Connecter-vous">
        </form>
    </body>
</html>

            

