<!DOCTYPE HTML>
<html>
<head>
  <style>
    body {background: url("/mnt/monster/home/eleves/f/fseurratboulaye/Images/Domotique.jpg") no-repeat center center fixed;
        background-repeat: no-repeat;
        background-size: 1280px 950px;
    }
    .error {color: #FF0000;
    }

    #logo1 {
    	position: absolute;
    	top: 50px;
    	right:0px;
    	width: 500px;
    	height: 200px;
    	background: url() 0 0;
    }
    div.static {
    position: absolute;
    left:375px;
    color :#08b6e1;
  }
</style>
</head>

<body>
	<img id="logo1" src="Images/logo_provisoire2.png" > 
	</img>

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
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i" ,$website )) {
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

  <h1><div class="static"><i><u>Dossier d'inscription MaisoNET</u></i></div></h1>
  <p><span class="error">* zone obligatoire</span></p> 
  
  <form method="post" action= >   
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
    Comment: <textarea name="commentaire" rows="5" cols="40"></textarea>
    <br><br>
    Genre:
    <input type="radio" name="genre" value="Femme" > <?php if (isset($gender) && $gender=="femme" ) echo "checked" ;?> Femme
    <input type="radio" name="genre" value="Homme"> <?php if (isset($gender) && $gender=="homme" ) echo "checked" ;?> Homme
    <input type="radio" name="genre" value="Autre"> <?php if (isset($gender) && $gender=="autre" ) echo "checked" ;?> Autre
    <span class="error"><?php echo $genreError;?></span>
    <br><br>
    <input type="submit" name="Submit" value="Submit">
  </form>
  </body>

</html>
