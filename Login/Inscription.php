html 

<?php
    $nom = "";
    $adresse = "";
    $numerotelephone = "";
    $datenaissance = "";
    $pays = "";
    $codepostal = "";
    $email = "";
    $genre = "";
    $commentaire = "";
    $site = "";

    $nomErreur = "";
    $adresseErreur = "";
    $numerotelephoneErreur = "";
    $datenaissanceErreur = "";
    $paysErreur = "";
    $codepostalErreur = "";
    $emailErreur = "" ;
    $genreErreur = "";
    $siteErreur = "";

  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {                                     
      //Vérifie que le serveur demande des données (POST)

    if (empty($_POST["nom"])) {    
      //Cas où la case nom n'est pas remplie
      $nomErreur = "Le nom est obligatoire";
        
    } else {
        
      $nom = test_input($_POST["nom"]);                                          

      if (!preg_match("/ ^ [a-zA-Z ] * $ /",$nom)) {     
        // Vérifie que le nom ne comporte que des lettres et des espaces
        $nomErreur = "Seulement des lettres et des espaces sont acceptés";
          
      }
    }
    
    if (empty($_POST["numerotelephone"])) {    
      //Cas où la case numerotelephone n'est pas remplie
      $numerotelephoneErreur = "Le numéro de téléphone est obligatoire";
        
    } else {
      
      $numerotelephone = test_input($_POST["numerotelephone"]);                                          

      if ($numerotelephone>9999999999) {     
        // Vérifie que le numero de téléphone comporte 12 nombres
        $numerotelephoneErreur = "Numéro de téléphone incorrecte";
          
      }
    }
     
    if (empty($_POST[ "datenaissance" ])) {
      $datenaissance = "";
        } else {
      $datenaissance = test_input($_POST[ "datenaissance" ]);
     }
    if (empty($_POST[ "site" ])) {
      $site = "";
        } else {
      $datenaissance = test_input($_POST[ "site" ]);
     }
     
    if (empty($_POST[ "pays" ])) {
      $pays = "";
        } else {
      $pays = test_input($_POST[ "pays" ]);
     }
    
    if (empty($_POST[ "codepostal" ])) {
      $codepostal = "";
        } else {
      $codepostal = test_input($_POST[ "codepostal" ]);
     }
      
    if (empty($_POST["email"])) {
      //Cas où la case email n'est pas remplie  
      $emailErreur = "Le mail est obligatoire";
        
    } else {

      $email = test_input($_POST["email"]);                                      

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        // Vérifie que le format mail est valide
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
  
  if (isset($genre) && $genre == "femme" ) {echo "femme cochée" ;}
  if (isset($genre) && $genre == "homme" ) {echo "homme coché" ;}
  if (isset($genre) && $genre == "autre" ) {echo "autre coché" ;}
  
    //Vérification

  echo $nom ;
  echo $adresse ;
  echo $datenaissance ; 
  echo $numerotelephone ;
  echo $pays ; 
  echo $codepostal ;
  echo $email ;
  echo $site ;
  echo $commentaire ; 
  echo $genre ; 
  
  echo $nomErreur ;
  echo $adresseErreur ;
  echo $datenaissanceErreur ;
  echo $numerotelephoneErreur ;
  echo $paysErreur ; 
  echo $codepostalErreur ;
  echo $emailErreur ;
  echo $siteErreur ;
  echo $commentaireErreur ; 
  echo $genreErreur ; 

  ?>
