<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
<div class="card">
    <h2 class="titre-inscription">Inscription</h2>


    <form method="post" action="register.php">

        <?php include('errors.php'); ?>

        <div class="aligner">
            <label>Nom</label>
            <input type="text" name="nom" value="<?php echo $name; ?>">
        </div>
        <div class="aligner">
            <label>Prénom</label>
            <input type="text" name="prenom" value="<?php echo $prenom; ?>">
        </div>
        <div class="aligner">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="aligner">
            <label>Date de naissance</label>
            <input type="date" name="datenaissance" valueb="<?php echo $datenaissance; ?>">
        </div>

        <div class="aligner">
            <label>N°de Telephone</label>
            <input type="tel" name="numtel" value="<?php echo $numtel; ?>">
        </div>
        <div class="aligner">
            <label>Mot de passe</label>
            <input type="password" name="password_1">
        </div>
        <div class="aligner">
            <label>Confirmer mot de passe</label>
            <input type="password" name="password_2">
        </div>
        <div class="aligner">
            <button type="submit" class="btn" name="reg_user">Inscription</button>
        </div>
        <p class="lien-inscription">

            Déja membre? <a href="login.php">Connectez vous</a>
        </p>
    </form>
</div>
</body>
</html>