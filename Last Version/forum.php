<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>User Interface</title>

  <link rel="stylesheet" href="forum.css"> <!--feuille css-->
  <link rel="icon" href="Images-forum/favicon.png"> <!--icone-->

    <script type="text/javascript" src="forumScripts.js" ></script>

</head>

<body>

<?php
/*$mysqli = new mysqli('172.16.231.201', '', '', 'maisonet');

if ($mysqli->connect_errno) {
    die('<p>Connexion impossible : '.$mysqli->connect_error.'</p>');
}
$result = $mysqli->query('SELECT nom, prenom FROM utilisateurs;') ;
if (!$result) {
    die('<p>ERREUR Requête invalide : '.$mysqli->error.'</p>');
}
while ($row = $result->fetch_assoc()) {
    $nom = $row['nom'] ;
    $prenom = $row['prenom'] ;
    echo '<p>'.$prenom.' '.$nom.'</p>'."\r\n" ;
}
$result->free() ;
$mysqli->close() ;*/
?>

	<img class="avatar" src="Images-forum/avatar.png" onclick="openNav()"> </img>
	<div id="mySidenav" class="sidenav">
		<a href="javascript:closeNav()" class="closebtn">&times;</a>
		<!-- la croix pour fermer -->
		<a href="#">Profil</a>
		<a href="#">Services</a>
		<a href="#">Contact</a>
		<a href="index.php">Déconnexion</a>
	</div>

<picture class ="logo">
    <source media="(max-width: 480px)" srcset="Images-forum/logo_provisoire2.png">
    <source srcset="Images-forum/logo_provisoire2.png">
    <img src="Images-forum/logo_provisoire2.png"/>
</picture>

<div id="menu">
  <div id="onglets">

    <h2>Forums</h2>
    <ul id="myMenu">
      <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
      <li><a id="defaultOpen" href="javascript:openPage('Accueil', this)">Accueil</a></li>
      <li><a href="javascript:openPage('General', this)">Général</a></li>
      <li><a href="javascript:openPage('Compte', this)">Compte</a></li>
      <li><a href="javascript:openPage('Assistance', this)">Assistance</a></li>
      <li><a href="javascript:openPage('CeMACs', this)">CeMACs</a></li>
      <li><a href="javascript:openPage('Autres', this)">Autres</a></li>
    </ul>
  </div>



 <div id="Accueil" class="Elements">
    <h2>Utilisation</h2>
     <?php
     $element = "
<div class=\"divTable post\">
    <div class=\"divTableHeading\">
        <div class=\"divTableRow\">
            <div class=\"divTableHead\">Sujet</div>
        </div>
    </div>
    <div class=\"divTableBody\">
        <div class=\"divTableRow\">
            <div class=\"divTableCell\">Details</div>
        </div>
    </div>
</div>
";
     $count = 6;
     for ($i = 0; $i < $count; $i++) {
     echo $element;
     }

     ?>
 </div>

  <div id="General" class="Elements">
    <h2>General</h2>
    <p>forum</p>
  </div>

  <div id="Compte" class="Elements">
    <h2>Compte</h2>
    <p>forum</p>
  </div>

  <div id="Assistance" class="Elements">
    <h2>Assistance</h2>
    <p>forum</p>
  </div>

  <div id="CeMACs" class="Elements">
    <h2>CeMACs</h2>
    <p>forum</p>
  </div>

  <div id="Autres" class="Elements">
    <h2>Autres</h2>
    <p>forum</p>
  </div>




</div>

<script>
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>


</body>