<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Inscription</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Nom</label>
			<input type="text" name="nom" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label>Prénom</label>
			<input type="text" name="prenom" value="<?php echo $prenom; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Date de naissance</label>
			<input type="date" name="datenaissance" valueb="<?php echo $datenaissance;?>">
		</div>

		<div class="input-group">
			<label>N°de Telephone</label>
			<input type="tel" name="numtel" value="<?php echo $numtel;?>">
		<div class="input-group">
			<label>Mot de passe</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirmer mot de passe</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Inscription</button>
		</div>
		<p>
			Déja membre? <a href="login.php">Connectez vous</a>
		</p>
	</form>
</body>
</html>