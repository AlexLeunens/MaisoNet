<!doctype html>
<html lang="fr">

<head>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
  	<title>User Interface</title>

  	<link rel="stylesheet" href="usermain.css"> <!--feuille css-->
 	 <link rel="icon" href="Images-utilisateur/logo_provisoire_mini.png"> <!--icone-->
  
</head>

<body>

	<img id="logo" src="Images-utilisateur/logo_provisoire2.png"> </img>
	<!--<a href="absent.html" ><img id="switch" src="Images-utilisateur/switchOn.png"> </img> </a> -->


	<img class="avatar" src="Images-utilisateur/avatar.png" onclick="openNav()"> </img>
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
	  <a href="Nos_services.php">Services</a>
	  <a href="" onclick= "popupContact()" >Contact</a>
	  <a href="index.php">Se Déconnecter</a>
	</div>




	<div id="menu">  <!--conteneur-->
		<ul id="onglets">  <!--commence la liste et lui donne l'id onglet-->
			<li><a id="defaultOpen" href="javascript:openPage('Client', this)"> Client </a></li>
			<li><a href="javascript:openPage('Contact', this)"> Contact </a></li>
			<li><a href="javascript:openPage('Notification', this)"> Notification </a></li>
			<li><a href="javascript:openPage('GestClient', this)"> Gestion Client </a></li>
	
  		</ul>
	</div>
	

	<div id= "Client" class="Elements">
		<form class="dossier" method="post" action="php/user_id.php">
			No. client : <input type="text" name="username" >
		<input  align="right" type="submit" value="Entrée" >
		</form>
		<p class="piece">Salon</p>
			<div class="panel">
				<div class=bloc><a href="#masquetemp">
				<img class="imagestemperature" src="Images-utilisateur/temperature+.png" alt="temperature"></img>
				<p class=sstitre>Votre Temperature</p></a>
				</div>
				<div class=bloc><a href="#masquevolet">
				<img class="imagesbutton" src="Images-utilisateur/volet.png" alt="volets"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
				<div class=bloc><a href="#masqueplus">
				<img class="imagesbuttonplus" src="Images-utilisateur/plus.png" alt="plus"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
			</div>

		<p class="piece">Chambre 1</p>
			<div class="panel">
				<div class=bloc><a href="#masquetemp">
				<img class="imagestemperature" src="Images-utilisateur/temperature+.png" alt="temperature"></img>
				<p class=sstitre>Votre Temperature</p></a>
				</div>
				<div class=bloc><a href="#masquevolet">
				<img class="imagesbutton" src="Images-utilisateur/volet.png" alt="volets"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
				<div class=bloc><a href="#masqueplus">
				<img class="imagesbuttonplus" src="Images-utilisateur/plus.png" alt="plus"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
			</div>

		<p class="piece">Salle A Manger</p>
			<div class="panel">
				<div class=bloc><a href="#masquetemp">
				<img class="imagestemperature" src="Images-utilisateur/temperature+.png" alt="temperature"></img>
				<p class=sstitre>Votre Temperature</p></a>
				</div>
				<div class=bloc><a href="#masquevolet">
				<img class="imagesbutton" src="Images-utilisateur/volet.png" alt="volets"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
				<div class=bloc><a href="#masqueplus">
				<img class="imagesbuttonplus" src="Images-utilisateur/plus.png" alt="plus"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
			</div>
	</div>


	<div id= "Contact" class="Elements" style="display:none;">
        <?php
            $mysqli = new mysqli('localhost', 'root', 'root', 'formation_mysql');

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
            $mysqli->close() ;
        ?>
		</div>
	<div id= "Notification" class="Elements" style="display:none;">
		
		</div>
	<div id= "GestClient" class="Elments" style="display:none;">
		
		</div>


	<p><a href="#masquetemp"></a></p>
		<div id="masquetemp">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/fmodale_fermer.jpg" /></a>
			<h2>Votre température:</h2>
			<form>
				<input type="button" value=" - " onClick="javascript:this.form.champ.value--;">
				<input type="text1" name="champ" value="0">°C
				<input type="button" value=" + " onClick="javascript:this.form.champ.value++;">
			</form>
		  </div> <!-- .fenetre-modale -->
		</div> <!-- #masque -->
 	 <p><a href="#masquevolet"></a></p>
		<div id="masquevolet">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/fmodale_fermer.jpg" /></a>
			<h2>Etat des volets:</h2>
			<!-- ICI Ajouter l'a liste des capteurs l'état ouvert ou fermé du volet -->
		  </div> <!-- .fenetre-modale -->
		</div> <!-- #masque -->
 	 <p><a href="#masqueplus"></a></p>
		<div id="masqueplus">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/fmodale_fermer.jpg" /></a>
			<h2>Quel capteur voulez vous ajouter:</h2>
			<!-- ICI Ajouter la liste des capteurs -->
		  </div> <!-- .fenetre-modale -->
		</div> <!-- #masque -->
	<script>
for (var piece = document.getElementsByClassName("piece"), panel = document.getElementsByClassName("panel"), i = 0; i < piece.length; i++) {
	piece[i].onclick = function () {
		var a = !this.classList.contains("active");
		setClass(piece, "active", "remove");
		setClass(panel, "show", "remove");
		a && (this.classList.toggle("active"), this.nextElementSibling.classList.toggle("show"));
	};
}
var help = document.getElementsByClassName("help"),
	helpPanel = document.getElementsByClassName("helpPanel");
help[0].onclick = function () {
	var a = !this.classList.contains("active");
	setClass(help, "active", "remove");
	setClass(helpPanel, "show", "remove");
	a && (this.classList.toggle("active"), this.nextElementSibling.classList.toggle("show"));
};

function setClass(a, d, b) {
	for (var c = 0; c < a.length; c++) {
		a[c].classList[b](d);
	}
}

function openNav() {
	document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
}

function popupHelp() {
	window.open("FAQ.html", "", "width=1200, height=1000");
}

function popupContact() {
	window.open("contact.html", "", "width=800, height=500, left=500px, top=200px");
}

function openPage(a, d) {
	var b;
	var c = document.getElementsByClassName("Elements");
	for (b = 0; b < c.length; b++) {
		c[b].style.display = "none";
	}
	document.getElementById(a).style.display = "block";
	d.classList.toggle("focus");
}
document.getElementById("defaultOpen").click();
	</script>
	 

</body>
</body>

</html>
