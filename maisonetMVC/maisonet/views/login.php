<?php
//include_once(ROOT.'/models/server.php');

$title ="Registration system PHP and MySQL";
$css = "/maisonet/views/style1.css";
require ROOT."/views/template/header.php";
?>

<body>

<div class="card">
    <h2 class="titre-inscription">Connexion</h2>


    <form method="post" action="index.php?action=login">

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