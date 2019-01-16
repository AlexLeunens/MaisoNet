<?php
include 'secure.php';
?>
<?php
	session_start();

	// Déclaration des Variables
	$name = "";
	$prenom="";
	$datenaissance="";
	$numtel="";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	
	$db = mysqli_connect('localhost', 'root', 'root', 'maison');

	// Inscription
	if (isset($_POST['reg_user'])) {
		
		$name =  Securite::html($_POST['nom']);
		$prenom= Securite::html$_POST(['prenom']);
		$email = Securite::html$_POST(['email']);
		$datenaissance= Securite::html$_POST(['datenaissance']);
		$password_1 =Securite::html$_POST(['password_1']);
		$password_2 =Securite::html$_POST(['password_2']);
		$numtel=Securite::html($_POST['numtel']);

		
		if (empty($name)) { array_push($errors, "Le nom est obligatoire"); }
		if (empty($prenom)){array_push($errors,"Le prénom est obligatoire");}
		if (empty($email)) { array_push($errors, "L'email est obligatoire"); }
		if (empty($datenaissance)) { array_push($errors,"La date de naissance est obligatoire");}
		if (empty($password_1)) { array_push($errors, "Le mot de passe est obligatoire"); }
		if (empty($numtel)){array_push($errors,"Le numéro de téléphone est obligatoire");}

		if ($password_1 != $password_2) {
			array_push($errors, "Les deux mots de passe ne conviennent pas");
		}

		
		if (count($errors) == 0) {
			$password = ($password_1);
			$query = "INSERT INTO `utilisateurs` (`id`, `Nom`, `Prenom`, `Date_de_naissance`, `E-mail`, `mdp`, `N°_Téléphone`) VALUES ('', $name, $prenom, $datenaissance, $email, $password, $numtel)";
			$results=mysqli_query($db, $query);
			if (mysqli_num_rows($results==1)){
				$_SESSION['name']=$name;
				$_SESSION['sucess']="Vous êtes connecté.";

				header('location: index.php');


			}else{
				array_push($errors,"Erreur de connexion");
			}
			
		}

	}

	

	// LOGIN 
	if (isset($_POST['login_user'])) {
		$name = Securite::bdd($db,$_POST['nom']);
		$prenom= Securite::bdd($db,$_POST['prenom']);
		$password = Securite::bdd($db,$_POST['password']);

		if (empty($name)) {
			array_push($errors, "Le Nom est requis");
		}
		if (empty($password)) {
			array_push($errors, "Le mot de passe est requis");
		}

		if (count($errors) == 0) {
			$query = "SELECT * FROM utilisateur WHERE nom='$name' AND mdp='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $name;
				$_SESSION['success'] = "Vous êtes connecté";
				$type1="SELECT types FROM fonction INNER JOIN utilisateur ON fonction.utilisateur_idutilisateur=utilisateur.idutilisateur WHERE utilisateur.nom='$name'";
				$result_type=mysqli_query($db,$type1) or die(mysqli_error());
				$row=mysqli_fetch_assoc($result_type);

				if ($row['types']=="Admin"){
					header('location: usermain1.php');

				}
				else if ($row['types']=="Utilisateur"){
					header('location: utilisateur1.php');
				}
				
			}else {
				array_push($errors, "Mauvais nom/mot de passe");
			}
		}
	}

?>
