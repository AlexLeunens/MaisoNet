<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>

	<div class="card">
		<h2 class="titre-inscription">Connexion</h2>
	
	
		<form method="post" action="login.php">

			<?php include('errors.php'); ?>

			<div class="aligner">
				<label>Nom</label>
				<input type="text" name="nom" >
			</div>
			<div class="aligner">
				<label>Prénom</label>
				<input type="text" name="prenom" >
			</div>
			<div class="aligner">
				<label>Mot de passe</label>
				<input type="password" name="password">
			</div>
			<div class="aligner">
				<button type="submit" class="btn" name="login_user">Connexion</button>
			</div>
			<p class="lien-inscription">
				Vous n'êtes pas membre?<a href="register.php">Inscrivez vous</a>
			</p>
		</form>
	</div>


</body>
</html>