<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Connexion</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Nom</label>
			<input type="text" name="nom" >
		</div>
		<div class="input-group">
			<label>Prénom</label>
			<input type="text" name="prenom" >
		</div>
		<div class="input-group">
			<label>Mot de passe</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Connexion</button>
		</div>
		<p>
			Vous n'êtes pas membre?<a href="register.php">Inscrivez vous</a>
		</p>
	</form>


</body>
</html>