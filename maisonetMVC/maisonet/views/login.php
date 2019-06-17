<?php

$title = "Registration system PHP and MySQL";

require ROOT . "/views/template/headerAccueil.php";
include ROOT . "/models/connect.php";

if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    session_start();
    $sql = "SELECT * FROM utilisateur WHERE Email = '" . $_POST["email"] . "' ";
    $req = $conn->query($sql);

    if ($req) {
        $result = $req->fetch_assoc();
        if (password_verify($_POST["password"], $result['Mot de passe'])) {   //$password == $result['password']) {

            $_SESSION['id'] = $result['idUtilisateur'];
            $_SESSION['name'] = $result['Nom'];
            $_SESSION['firstname'] = $result['Prenom'];
            $_SESSION['email'] = $result['Email'];
            $_SESSION['tel'] = $result['Numero telephone'];
            $_SESSION['birthday'] = $result['Date de naissance'];
            //$_SESSION['type'] = $result['Fonction_idType'];

            $sql = "SELECT `Type` FROM fonction WHERE Utilisateur_idUtilisateur = " . $result['idUtilisateur'] . " ";
            $result = $conn->query($sql);
            $type = $result->fetch_assoc();
            $_SESSION['type'] = $type["Type"];

            if ($_SESSION['type'] === "Utilisateur") {
                //seeUserPage();
                unset($_POST);
                header('Location: index.php?action=see_userPage');
            } else {
                //seeAdminPage();
                unset($_POST);
                header('Location: index.php?action=see_adminPage');
            }

        } else {
            echo "<script>alert('Erreur lors de la vérification du mot de passe')</script>";
            //header('Location: index.php?action=see_login');
        }

    } else {
        echo "<script>alert('Utilisateur introuvable')</script>";
        //header('Location: index.php?action=see_login');
    }

    unset($_POST);
    //header("Location: " . $_SERVER['REQUEST_URL']);
}
?>

<body>


<a href="index.php" class="back"></a>
<img class="logoConnect" src="Images-accueil/maisonlogolong.png"> </img>

<div class="card connect">
    <h2 class="titre-inscription">Connexion</h2>


    <form method="post" action="">

        <div class="aligner">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="aligner">
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>
        <div class="aligner">
            <button type="submit" class="btn" name="login_user">Connexion</button>
        </div>
    </form>

    <p class="lien-inscription" style="bottom: 0;">
        Vous n'êtes pas membre?<a href="index.php?action=see_register">Inscrivez vous</a>
    </p>
</div>


</body>
</html>