<?php

//include_once(ROOT.'/models/server.php');

$title = "Inscription";
$css = "/maisonetgit/maisonetMVC/maisonet/views/accueil.css";
require ROOT . "/views/template/headerAccueil.php";
?>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<body>
<div class="card">
    <h2 class="titre-inscription">Inscription</h2>


    <form method="post" action="index.php?action=register_request">

        <?php //include_once(ROOT.'/models/errors.php'); ?>

        <div class="aligner">
            <label>Nom</label>
            <input type="text" name="nom" required>
        </div>
        <div class="aligner">
            <label>Prénom</label>
            <input type="text" name="prenom" required>
        </div>
        <div class="aligner">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="aligner">
            <label>Date de naissance</label>
            <input type="date" name="datenaissance" required>
        </div>

        <div class="aligner">
            <label>N°de Telephone</label>
            <input type="tel" name="numtel" required>
        </div>

        <div class="aligner">
            <label>Mot de passe</label>
            <input type="password" name="password_1" id="txtNewPassword" required>
        </div>
        <div class="aligner">
            <label>Confirmer mot de passe</label>
            <input type="password" name="password_2" id="txtConfirmPassword" onChange="checkPasswordMatch();" required>
        </div>

        <div id="divCheckPasswordMatch">
        </div>


        <div class="aligner">
            <button type="submit" class="btn" name="reg_user" id="submitButton">Inscription</button>
        </div>
        <p class="lien-inscription">

            Déja membre? <a href="index.php?action=see_login">Connectez vous</a>
        </p>
    </form>
</div>


<script>
    function checkPasswordMatch() {
        var password = $("#txtNewPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();

        if (password != confirmPassword){
            $("#divCheckPasswordMatch").html("Passwords do not match!");
            $("#submitButton").prop('disabled', true);
        }

        else{
            $("#divCheckPasswordMatch").html("Passwords match.");
            $("#submitButton").prop('disabled', false);
        }

    }

    $(document).ready(function () {
        $("#txtNewPassword, #txtConfirmPassword").keyup(checkPasswordMatch);
    });
</script>

</body>
</html>