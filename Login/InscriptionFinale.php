<!DOCTYPE HTML>
<html lang="fr">
<head>
   <link rel="stylesheet" href= "Inscription.css" >    <!--Appel du code CSS-->
   <link rel="stylesheet" href= "Inscription.php" >    <!--Appel du code PHP-->
   html 

    {   background:url("maison_connectee.jpg") no-repeat center;
        background-repeat: no-repeat;
        background-size: cover; 
        background-attachment: fixed;
    }
  
    .erreur {color: #FF0000;
      position:relative;
      top:30px;
      left:30px;
    }
  
    .aligner{position:relative;
      top:30px;
      left:30px;
      color:#2a5483;
      font-size:20px;
    }
  
    .button{position:relative;
      top:30px;
      left:30px;
      width:300px;
      height:50px;
      font-size:30px;
    }
    .ligne{
        position:relative;
        top:30px;
        left:30px;
}
  
    #logo1 {
    	position:fixed;
    	top: 22%;
    	right:30%;
    	background: url() 0 0;
    }
  
    div.static {
    position: fixed;
    top:2%;
    left:20%;
    font-size:45px;
    color :#3e9ff0;
  }
.sélection {
    position:relative;
    top:15px;
    left:40px;
    color:black;
}

.card {
  background-image:url("logo_provisoire_mini.png");
  background-repeat:no-repeat;
  background-position:right top;
    
  position : fixed;
  width: 50%;
  height: 80%;
  left:25%;
  top:12%; 
    
  opacity:0.95;
  background-color: white;  
    
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  border-radius: 5px;
    
  display: inline-block;
  overflow:scroll;
  overflow-x:hidden;

}
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}
</head>
<title>Dossier d'inscription MaisoNet</title>
<body>

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
      echo $nomErreur;
        
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
      if (!filter_var($numerotelephone, FILTER_VALIDATE_INT)) {     
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

?>
  <form method="post" action= "ConfirmationInscription.php" >

    <h1><div class="static"><i><u>Dossier d'inscription MaisoNET</u></i></div></h1>

    <div class="card">
	    
	<p><span class="erreur">* Zone obligatoire</span></p> 
	<br>
	    
        <div class="aligner">Nom: </div><input class="ligne" type="text" name="nom" >
        <span class="erreur"> * <?php echo 'Bonjour';?> </span>
        <br><br>

        <div class="aligner">Adresse: </div><input class="ligne" type="text" name="adresse" >
        <span class="erreur">*</span>
        <br><br>
	    
	<div class="aligner">Numéro de téléphone: </div><input class="ligne" type="tel" name="numerotelephone" >
        <span class="erreur"> * </span>
        <br><br>
	    
        <div class="aligner">Date de Naissance: </div><input class="ligne" type="date" name="datenaissance" >
        <span class="erreur">*</span>
        <br><br>

        <div class="aligner">Pays: </div><input class="ligne" type="text" name="pays" >
        <span class="erreur">*</span>
        <br><br>

        <div class="aligner">Code Postal: </div><input class="ligne" type="text" name="codepostal" >
        <span class="erreur">*</span>
        <br><br>

        <div class="aligner">E-mail: </div> <input class="ligne" type="email" name="mail">
        <span class="erreur">* </span>
        <br><br>

        <div class="aligner">Site Web: </div> <input class="ligne" type="url" name="site">
        <span class="erreur"></span>
        <br><br>

        <div class="aligner">Commentaire: </div> <textarea class="ligne" name="commentaire" rows="5" cols="40"></textarea>
        <br><br>

        <div class="aligner"><u>Genre: </u></div>
        <br><br>
    
        <div class="sélection"><font size="+2">Femme <input type="radio" name="genre1" value="Femme" ></font></div>
   
	<div class="sélection"><font size="+2"> Homme <input type="radio" name="genre2" value="Homme"></font></div> 

	<div class="sélection"><font size="+2"> Autre <input type="radio" name="genre3" value="Autre"> </font></div>
	<br>
		
        <input class="button" type="submit" name="Envoyer" value="Envoyer" >
	<br>
		
    </div>
  </form>
  </body>

</html>
