html {

<?php
    $nom = "";
    $adresse = "";
    $datenaissance = "";
    $pays = "";
    $codepostal = "";
    $email = "";
    $genre = "";
    $commentaire = ""
    $website = "";

    $nomErreur = "";
    $adresseErreur = "";
    $datenaissanceErreur = "";
    $paysErreur = "";
    $codepostalErreur = "";
    $emailErreur = "" ;
    $genreErreur = "";
    $websiteErreur = "";

  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {                                     //Vérifie que le serveur demande des données (POST)

    if (empty($_POST["nom"])) {                                                  //Cas où la case nom n'est pas remplie
      $nomErreur = "Le nom est obligatoire";
    } else {
      $nom = test_input($_POST["nom"]);                                          

      if (!preg_match("/ ^ [a-zA-Z ] * $ /",$nom)) {                                  // Vérifie que le nom ne comporte que des lettres et des espaces
        $nomErreur = "Seulement des lettres et des espaces sont acceptés";
      }
    }
    
    if (empty($_POST["email"])) {
      $emailErreur = "Le mail est obligatoire";
    } else {

      $email = test_input($_POST["email"]);                                      

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {                           // Vérifie que le format mail est valide
        $emailErreur = "Le format mail est invalide";
       }
    }

    if (empty($_POST[ "commentaire" ])) {
      $commentaire = "";
    } else {
      $commentaire = test_input($_POST[ "commentaire" ]);
    }
  
    if (empty($_POST[ "genre" ])) {
      $genreErreur = "Le genre est obligatoire";
    } else {
      $genre = test_input($_POST[ "genre" ]);
    }
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  if (isset($genre) && $genre == "femme" ) echo "checked" ;
  if (isset($genre) && $genre == "homme" ) echo "checked" ;
  if (isset($genre) && $genre == "autre" ) echo "checked" ;
  
  echo $nom ;
  echo $adresse ;
  echo $datenaissance ; 
  echo $pays ; 
  echo $codepostal ;
  echo $email ;
  echo $website ;
  echo $commentaire ; 
  echo $genre ; 
  
  echo $nomErreur ;
  echo $adresseErreur ;
  echo $datenaissanceErreur ; 
  echo $paysErreur ; 
  echo $codepostalErreur ;
  echo $emailErreur ;
  echo $websiteErreur ;
  echo $commentaireErreur ; 
  echo $genreErreur ; 

  ?>
