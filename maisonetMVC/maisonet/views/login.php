<?php
//include_once(ROOT.'/models/server.php');
// TODO password verification !!!

$title = "Registration system PHP and MySQL";

require ROOT . "/views/template/headerAccueil.php";
include ROOT . "/models/connect.php";

if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    session_start();
    $sql = "SELECT * FROM utilisateur WHERE Email = '" . $_POST["email"] . "' ";
    echo $sql;
    $req = $conn->query($sql);

    if ($req) {
        echo "been first";
        $result = $req->fetch_assoc();
        //if (password_verify($_POST["password"], $result['Mot de passe'])) {   //$password == $result['password']) {
        echo "been here";

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

        echo "been there";

        if ($_SESSION['type'] === "Utilisateur") {
            //seeUserPage();
            unset($_POST);
            header('Location: index.php?action=see_userPage');
        } else {
            //seeAdminPage();
            unset($_POST);
            header('Location: index.php?action=see_adminPage');
        }

        //} else {
        //   echo "<script>alert('utilisateur introuvable, else 1')</script>";
        //   //header('Location: index.php?action=see_login');
        //}


    } else {
        echo "<script>alert('utilisateur introuvable, else 2')</script>";
        //header('Location: index.php?action=see_login');
    }

    unset($_POST);
    //header("Location: " . $_SERVER['REQUEST_URL']);
}
?>

<body>

<div class="card">
    <h2 class="titre-inscription">Connexion</h2>


    <form method="post" action="">

        <?php //include_once(ROOT.'/models/errors.php'); ?>

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
        <p class="lien-inscription">
            Vous n'êtes pas membre?<a href="index.php?action=see_register">Inscrivez vous</a>
        </p>
    </form>
</div>


</body>
</html>