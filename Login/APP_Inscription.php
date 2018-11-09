<!DOCTYPE HTML>
<html>
<head>
  <style>
    .erreur {color: #FF0000;}
</style>
</head>
<body>
 <?php
    $nomErreur = "";
    $emailErreur = "" ;
    $genreErreur = "";
    $siteErreur = "";
    $nom = "";
    $email = "";
    $genre = "";
    $commentaire = ""
    $site = "";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nom"])) {
      $nomErreur = "Le nom est obligatoire";
    } else {
      $nom = test_input($_POST["nom"]);
      // Vérifier que le nom ne comporte que des lettres et des espaces
      if (!preg_match(" /^[a-zA-Z ]*$ /",$nom)) {
        $nomErreur = "Seulement des lettres et des espaces sont acceptés";
      }
    }
    
    if (empty($_POST["email"])) {
      $emailErreur = "Le mail est obligatoire";
    } else {
      $email = test_input($_POST["email"]);
      // Vérifier que le format mail est valide
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErreur = "Le format mail est invalide";
      }
    }
      
    if (empty($_POST["site" ])) {
      $site = "";
    } else {
      $site = test_input($_POST["site" ]);
      // Vérifier que la syntaxe URL est valide
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\ .)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i" ,$website )) {
        $siteErreur = "URL invalide";
      }
    }
  
    if (empty($_POST["commentaire" ])) {
      $commentaire = "";
    } else {
      $commentaire = test_input($_POST["commentaire" ]);
    }
  
    if (empty($_POST["genre" ])) {
      $genreErreur = "Le genre est obligatoire";
    } else {
      $genre = test_input($_POST["genre" ]);
    }
  
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <h2>Dossier d'inscription MaisoNET</h2>
  <p><span class="erreur"> * zone obligatoire </span></p> 

  <form method="post" action= >               //Adresse de de MySql (à revoir possiblement)
    Nom: <input type="text" name="nom">
    <span class="erreur">*
      <?php echo $nomErreur;?></span>
    <br><br>
    E-mail: <input type="text" name="E-mail">
    <span class="erreur">*
      <?php echo $emailErreur;?></span>
    <br><br>
    Site Web: <input type="text" name="site web">
    <span class="erreur">
      <?php echo $siteErreur;?></span>
    <br><br>
    Comment: <textarea name="commentaire" rows="5" cols="40"></textarea>
    <br><br>
    Genre:
    <input type="radio" name="genre" value="Femme" > <?php if (isset($gender) && $gender=="femme" ) echo "checked" ;?> Femme
    <input type="radio" name="genre" value="Homme"> <?php if (isset($gender) && $gender=="homme" ) echo "checked" ;?> Homme
    <input type="radio" name="genre" value="Autre"> <?php if (isset($gender) && $gender=="autre" ) echo "checked" ;?> Autre
    <span class="error"><?php echo $genreError;?></span>
    <br><br>
    <input type="submit" name="Envoyer" value="Envoyer">
  </form>
  </body>

</html>
