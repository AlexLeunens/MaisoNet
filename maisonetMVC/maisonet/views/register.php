<?php

//include_once(ROOT.'/models/server.php');

$title ="Inscription";
$css = "/maisonet/views/style1.css";
require ROOT."/views/template/header.php";
?>


<body>
<div class="card">
    <h2 class="titre-inscription">Inscription</h2>


    <form method="post" action="register.php">

        <?php //include_once(ROOT.'/models/errors.php'); ?>

        <div class="aligner">
            <label>Nom</label>
            <input type="text" name="nom" value="<?php echo $name; ?>" required>
        </div>
        <div class="aligner">
            <label>Prénom</label>
            <input type="text" name="prenom" value="<?php echo $prenom; ?>" required>
        </div>
        <div class="aligner">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="aligner">
            <label>Date de naissance</label>
            <input type="date" name="datenaissance" valueb="<?php echo $datenaissance;?>" required>
        </div>

        <div class="aligner">
            <label>N°de Telephone</label>
            <input type="tel" name="numtel" value="<?php echo $numtel;?>" required>
        </div>

        <!--<div class="aligner">
            <label>Mot de passe</label>
            <input type="password" name="password_1" required>
        </div>
        <div class="aligner">
            <label>Confirmer mot de passe</label>
            <input type="password" name="password_2" required>
        </div>-->

        <div class="aligner">
            <button type="submit" class="btn" name="reg_user">Inscription</button>
        </div>
        <p class="lien-inscription">

            Déja membre? <a href="index.php?action=see_login">Connectez vous</a>
        </p>
    </form>
</div>
</body>
</html>