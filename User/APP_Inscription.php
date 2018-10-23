<!DOCTYPE HTML>
<html>
<head>
  <style>
    .error {color: #FF0000;}
</style>
</head>

<body>
 <?php
    $nameError = "";
    $emailError = "" ;
    $genreError = "";
    $websiteError = "";
    $name = "";
    $email = "";
    $genre = "";
    $commentaire = ""
    $website = "";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameError = "Le nom est obligatoire";
    } else {
      $name = test_input($_POST["name"]);
      // Vérifier que le nom ne comporte que des lettres et des espaces
      if (!preg_match(" /^[a-zA-Z ]*$ /",$name)) {
        $nameError = "Seulement des lettres et des espaces sont acceptés";
      }
    }
    
    if (empty($_POST["email"])) {
      $emailError = "Le mail est obligatoire";
    } else {
      $email = test_input($_POST["email"]);
      // Vérifier que le format mail est valide
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Le format mail est invalide";
      }
    }
      
    if (empty($_POST["website" ])) {
      $website = "";
    } else {
      $website = test_input($_POST["website" ]);
      // Vérifier que la syntaxe URL est valide
      if (!preg_match(" /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i " ,$website )) {
        $websiteError = "URL invalide";
      }
    }
  
    if (empty($_POST["commentaire" ])) {
      $commentaire = "";
    } else {
      $commentaire = test_input($_POST["comment" ]);
    }
  
    if (empty($_POST["genre" ])) {
      $genreError = "Le genre est obligatoire";
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

  <h2>Exemple de Validation par PHP</h2>
  <p><span class="error">* zone obligatoire</span></p>
  <form method="post" action= <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> >
    Nom: <input type="text" name="nom">
    <span class="error">*
      <?php echo $nameError;?></span>
    <br><br>
    E-mail: <input type="text" name="E-mail">
    <span class="error">*
      <?php echo $emailError;?></span>
    <br><br>
    Site Web: <input type="text" name="site web">
    <span class="error">
      <?php echo $websiteError;?></span>
    <br><br>
    Commentaire: <textarea name="commentaire" rows="5" cols="40"></textarea>
    <br><br>
    Genre:
    <input type="radio" name="genre" value="Femme"> <?php if (isset($gender) && $gender=="femme" ) echo "checked" ;?> Femme
    <input type="radio" name="genre" value="Homme"> <?php if (isset($gender) && $gender=="homme" ) echo "checked" ;?> Homme
    <input type="radio" name="genre" value="Autre"> <?php if (isset($gender) && $gender=="autre" ) echo "checked" ;?> Autre
    <span class="error"><?php echo $genreError;?></span>
    <br><br>
    <input type="submit" name="Submit" value="Submit">
  </form>
  </body>

</html>
