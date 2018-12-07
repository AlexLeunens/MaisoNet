<!doctype html>
<html lang="fr">

<head>
  	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
  	<title>User Interface</title>

  	<link rel="stylesheet" href="main.css"> <!--feuille css-->
 	 <link rel="icon" href="Images/logo_provisoire_mini.png"> <!--icone-->
  
</head>

<body>

	<img id="logo" src="Images/logo_provisoire2.png"> </img>
	<!--<a href="absent.html" ><img id="switch" src="Images/switchOn.png"> </img> </a> -->


	<img class="avatar" src="Images/avatar.png" onclick="openNav()"> </img>
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
	  <a href="#">Profil</a>
	  <a href="#">Services</a>
	  <a href="#">Contact</a>
	  <a href="#">Se Déconnecter</a>
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
				<div class=bloc><a href="#masque">
				<img class="imagestemperature" src="Images/temperature+.png" alt="temperature"></img>
				<p class=sstitre>Votre Temperature</p></a>
				</div>
				<div class=bloc><a href="#masque">
				<img class="imagesbutton" src="Images/volets2.png" alt="volets"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
			</div>

		<p class="piece">Chambre 1</p>
			<div class="panel">
				<div class=bloc><a href="#masque">
				<img class="imagestemperature" src="Images/temperature+.png" alt="temperature"></img>
				<p class=sstitre>Votre Temperature</p></a>
				</div>
				<div class=bloc><a href="#masque">
				<img class="imagesbutton" src="Images/volets2.png" alt="volets"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
			</div>

		<p class="piece">Salle A Manger</p>
			<div class="panel">
				<div class=bloc><a href="#masque">
				<img class="imagestemperature" src="Images/temperature+.png" alt="temperature"></img>
				<p class=sstitre>Votre Temperature</p></a>
				</div>
				<div class=bloc><a href="#masque">
				<img class="imagesbutton" src="Images/volets2.png" alt="volets"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
			</div>
	</div>


	<div id= "Contact" class="Elements" style="display:none;">
		<p>bonjour</p>
		</div>
	<div id= "Notification" class="Elements" style="display:none;">
		
		</div>
	<div id= "GestClient" class="Elments" style="display:none;">
		
		</div>

	<p class="help"> <img class="imageHelpMenu" src="Images/helpmenu.png" alt="Help"></img> </p>
	<div class="helpPanel">

		<a href="" onclick= "popupHelp()"><img class="imageshelp" src="Images/helpquestionmark.png" alt="FAQ"></img></a>

		<a href="" onclick= "popupContact()"><img class="imageshelp" src="Images/helptechnician.png" alt="Contact Tech"></img> </a>

		<img class="imageshelp" src="Images/helpadministrator.png" alt="Contact Admin"></img>

	</div>

	<p><a href="#masque"></a></p>
		<div id="masque">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images/fmodale_fermer.jpg" /></a>
			<h2>Bonjour</h2>
			<form>
				<input type="button" value=" - " onClick="javascript:this.form.champ.value--;">
				<input type="text1" name="champ" value="0">°C
				<input type="button" value=" + " onClick="javascript:this.form.champ.value++;">
			</form>
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
	 
<?php
	$contact = mysql_connect('localhost','root','root');
	mysql_select_db ('formation_mysql', $contact) ;
	$sql = 'SELECT Nom,Prénom FROM utilisateurs';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$data = mysql_fetch_array($req);
    echo ($data['Nom']);
    echo($data['Prénom']);
?>
</body>
</body>

</html>
