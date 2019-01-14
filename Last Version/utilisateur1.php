<!doctype html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title>User Interface</title>

    <link rel="stylesheet" href="Utilisateur.css"> <!--feuille css-->
    <link rel="icon" href="Images-utilisateur/maisonetlogo.png"> <!--icone-->
  
</head>

<body>

  <img class="avatar" src="Images-utilisateur/avatar.png" onclick="openNav()"> </img>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
    <a href="Services.html">Services</a>
    <a href="" onclick= "popupContact()" >Contact</a>
    <a href="index.php">Déconnexion</a>
  </div>




  <div id="menu">  <!--conteneur-->
    <img id="logo" src="Images-utilisateur/maisonlogolong.png"> </img>

    <ul id="onglets">  <!--commence la liste et lui donne l'id onglet-->
      <li id="liPresent" class="active"><a href="javascript:switchClick()"> Mode Présence </a></li>
      <li id="liAbsent"><a href="javascript:switchClick()"> Mode Absence </a></li>

      <label class="switch" onclick="openPage(this)">
        <input type="checkbox" id="switchPresence" unchecked>
        <span class="slider round"></span>
      </label>
      </ul>
  </div>
  

  <div id= "Present" class="fonctions">
      <p class="piece">Salon</p>
			<div class="panel">
				<div class="bloc"><a href="#masquetemp">
				<img class="imagesbutton" src="Images-utilisateur/temperature.png" alt="temperature"></img>
				<p>Votre Temperature</p></a>
				</div>
				<div class="bloc"><a href="#masquevolet">
				<img class="imagesbutton" src="Images-utilisateur/volets.png" alt="volets"></img>
				<p>Etat Volet</p></a>
				</div>
        			<div class="bloc"><a href="#masquehum">
				<img class="imagesbutton" src="Images-utilisateur/humidity.png" alt="humidité"></img>
				<p>Votre Humidité</p></a>
				</div>
        			<div class="bloc"><a href="#masquefum">
				<img class="imagesbutton" src="Images-utilisateur/fire_alarm.png" alt="fumée"></img>
				<p>Alerte Fumée : </p></a>
				</div>
        			<div class="bloc"><a href="#masqueCO2">
				<img class="imagesbutton" src="Images-utilisateur/pollution.png" alt="CO2"></img>
				<p>Alerte Gaz : </p></a>
        			</div>
				<div class="bloc"><a href="#masqueajoutcapteur">
        			<img class="imagesajoutcapteur" src="Images-utilisateur/AjoutCapteur.png" alt="temperature"></img>
        			</a></div>
			</div>

		<p class="piece">Chambre 1</p>
			<div class="panel">
				<div class="bloc"><a href="#masquetemp">
				<img class="imagesbutton" src="Images-utilisateur/temperature.png" alt="temperature"></img>
				<p>Votre Temperature</p></a>
				</div>
				<div class="bloc"><a href="#masquevolet">
				<img class="imagesbutton" src="Images-utilisateur/volets.png" alt="volets"></img>
				<p>Etat Volet</p></a>
				</div>
        			<div class="bloc"><a href="#masquehum">
				<img class="imagesbutton" src="Images-utilisateur/humidity.png" alt="humidité"></img>
				<p>Votre Humidité</p></a>
				</div>
				<div class="bloc"><a href="#masquefum">
				<img class="imagesbutton" src="Images-utilisateur/fire_alarm.png" alt="fumée"></img>
				<p class=sstitre>Alerte Fumée : </p></a>
				</div>
        			<div class="bloc"><a href="#masqueCO2">
				<img class="imagesbutton" src="Images-utilisateur/pollution.png" alt="CO2"></img>
				<p>Alerte Gaz : </p></a>
        			</div>
				<div class="bloc"><a href="#masqueajoutcapteur">
        			<img class="imagesajoutcapteur" src="Images-utilisateur/AjoutCapteur.png" alt="temperature"></img>
       				</a></div>
			</div>

		<p class="piece">Salle A Manger</p>
			<div class="panel">
				<div class="bloc"><a href="#masquetemp">
				<img class="imagesbutton" src="Images-utilisateur/temperature.png" alt="temperature"></img>
				<p class=sstitre>Votre Temperature</p></a>
				</div>
				<div class="bloc"><a href="#masquevolet">
				<img class="imagesbutton" src="Images-utilisateur/volets.png" alt="volets"></img>
				<p class=sstitre>Etat Volet</p></a>
				</div>
        			<div class="bloc"><a href="#masquehum">
				<img class="imagesbutton" src="Images-utilisateur/humidity.png" alt="humidité"></img>
				<p class=sstitre>Votre Humidité</p></a>
				</div>
        			<div class="bloc"><a href="#masquefum">
				<img class="imagesbutton" src="Images-utilisateur/fire_alarm.png" alt="fumée"></img>
				<p class=sstitre>Alerte Fumée : </p></a>
				</div>
        			<div class="bloc"><a href="#masqueCO2">
				<img class="imagesbutton" src="Images-utilisateur/pollution.png" alt="CO2"></img>
				<p class=sstitre>Alerte Gaz : </p></a>
				</div>
				<div class="bloc"><a href="#masqueajoutcapteur">
        			<img class="imagesajoutcapteur" src="Images-utilisateur/AjoutCapteur.png" alt="temperature"></img>
        			</a></div>
			</div>


  <div id= "Absent" class="fonctions" style="display:none;">
    <p class="piece">Economies</p>
    <div class="panel">
	<div class="bloc">
		<img class="imagesbutton" src="Images-utilisateur/volets.png" alt="volets"></img>
          	<p> Etat des Volets</p>
        </div>
        <div class="bloc">
          <img class="imagesbutton" src="Images-utilisateur/temperature.png" alt="temperature"></img>
          <p> Valeur Température</p>
        </div>
        <div class="bloc">
          <img class="imagesbutton" src="Images-utilisateur/humidity.png" alt="temperature"></img>
          <p> Valeur Humidité</p>
        </div>
        <div class="bloc">
          <img class="imagesbutton" src="Images-utilisateur/pollution.png" alt="temperature"></img>
          <p> Alerte : Fuite de Gaz</p>
        </div>
        <div class="bloc">
          <img class="imagesbutton" src="Images-utilisateur/fire_alarm.png" alt="temperature"></img>
          <p> Alerte : Fumée (Incendie)</p>
        </div>
    </div>


    <p class="piece">Sécurité</p>
     <div class="panel">
        <div class="bloc"><a href="#masquefum">
			<img class="imagesfumée" src="Images-utilisateur/Fumée.png" alt="fumée"></img>
			<p class=sstitre>Alerte Fumée : </p></a>
		</div>
        <div class="bloc"><a href="#masqueCO2">
			<img class="imagesCO2" src="Images-utilisateur/CO2.png" alt="CO2"></img>
			<p class=sstitre>Alerte Gaz : </p></a>
		</div>
        <div class="bloc"><a href="#masqueCO2">
			<img class="imagescaméra" src="Images-utilisateur/Caméra.png" alt="Caméra"></img>
			<p class=sstitre>Alerte Sécurité : </p></a>
		</div>
    </div>
   </div>


  <p class="help"> ? </p>
  <div class="helpPanel">

    <a href="" onclick= "tabFAQ()"><img class="imageshelp" src="Images-utilisateur/helpquestionmark.png" alt="FAQ"></img></a>
    

    <a href="" onclick= "popupContact()"><img class="imageshelp" src="Images-utilisateur/helptechnician.png" alt="Contact Tech"></img> </a>

  </div>
    <p><a href="#masquetemp"></a></p>
		<div id="masquetemp">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/CroixSortie.png" /></a>
			<h2>Votre température:</h2>
			<form>
				<input type="button" value=" - " onClick="javascript:this.form.champ.value--;">
				<input type="text1" name="champ" value="0">%
				<input type="button" value=" + " onClick="javascript:this.form.champ.value++;">
			</form>
		  </div> <!-- .fenetre-modale -->
		</div> <!-- #masque -->
    <p><a href="#masquehum"></a></p>
		<div id="masquehum">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/CroixSortie.png" /></a>
			<h2>Votre Humidité:</h2>
			<form>
				<input type="button" value=" - " onClick="javascript:this.form.champ.value--;">
				<input type="text1" name="champ" value="0">%
				<input type="button" value=" + " onClick="javascript:this.form.champ.value++;">
			</form>
		  </div> <!-- .fenetre-modale -->
		</div> <!-- #masque -->
    <p><a href="#masquefum"></a></p>
		<div id="masquefum">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/CroixSortie.png" /></a>
			<h2>Etat:</h2>
		  </div> <!-- .fenetre-modale -->
    </div> <!-- #masque -->
    <p><a href="#masqueajoutcapteur"></a></p>
		<div id="masqueajoutcapteur">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/CroixSortie.png" /></a>
			<h2>Liste des capteurs disponibles:</h2>
		  </div> <!-- .fenetre-modale -->
		</div> <!-- #masque -->
    <p><a href="#masqueCO2"></a></p>
		<div id="masqueCO2">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/CroixSortie.png" /></a>
			<h2>Etat:</h2>
		  </div> <!-- .fenetre-modale -->
		</div> <!-- #masque -->
    <p><a href="#masquecam"></a></p>
		<div id="masquecam">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/CroixSortie.png" /></a>
			<h2>Etat:</h2>
		  </div> <!-- .fenetre-modale -->
		</div> <!-- #masque -->
	<p><a href="#masqueajoutcapteur"></a></p>
		<div id="masqueajoutcapteur">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/CroixSortie.png" /></a>
			<h2>Pour ajouter des capteurs , cliquer sur <a href="contact.html">ce lien</a> et préciser à l'administrateur le capteur demandé.</h2>
		  </div> <!-- .fenetre-modale -->
		</div> <!-- #masque -->
  <p><a href="#masquevolet"></a></p>
		<div id="masquevolet">
		  <div class="fenetre-modale">
			<a class="fermer" href="#nullepart"><img alt="Bouton fermer la fenêtre" 
			  title="Fermer la fenêtre" class="btn-fermer" 
			  src="Images-utilisateur/CroixSortie.png" /></a>
			<h2>Etat des volets:</h2>
			<!-- ICI Ajouter l'a liste des capteurs l'état ouvert ou fermé du volet -->
		  </div> <!-- .fenetre-modale -->
		</div> <!-- #masque -->
  <script>
    var piece = document.getElementsByClassName("piece");
    var panel = document.getElementsByClassName('panel'); //selec piece et panel
    for (var i = 0; i < piece.length; i++) { //pour tout bouton
        piece[i].onclick = function() {
            var setClasses = !this.classList.contains('active'); //selec classes actives qui ne sont pas celle sur laquelle on a cliqué
            setClass(piece, 'active', 'remove'); //les rend inactives
            setClass(panel, 'show', 'remove'); // cache le contenu
            if (setClasses) {
                this.classList.toggle("active"); //rend celle cliquée active (piece)
                this.nextElementSibling.classList.toggle("show"); //affiche le contenu (panel)
            }
        }
    }
    
    var help = document.getElementsByClassName("help")
    var helpPanel = document.getElementsByClassName("helpPanel")    
    help[0].onclick = function() {
      var setClasses = !this.classList.contains('active'); // vérifie si help actif
      setClass(help, 'active', 'remove'); //les rend inactives
      setClass(helpPanel, 'show', 'remove'); // cache le contenu
      if (setClasses) { //si help pas deja actif
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
      }
    }
    function setClass(els, className, fnName) {
        for (var i = 0; i < els.length; i++) { //chaque piece selec avec !this.classList.contains('active')
            els[i].classList[fnName](className); //les prend une par une, puis désactive une propriété
        }
    }
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    function popupHelp() {
        var myWindow = window.open("FAQ.html", "", "width=1200, height=1000");
    }
    function popupContact() {
        var myWindow = window.open("contact.html", "", "width=800, height=500, left=500px, top=200px");
    }
    
    function tabFAQ() {
      var win = window.open("FAQ.html", '_blank');
    win.focus();
    }
    function switchClick(){
      document.getElementById("switchPresence").click();
    }
    function openPage(elmnt) {
        var i, tabcontent, pageName, ongletActif;
        var checkBox = document.getElementById("switchPresence");
        var ongletPresent = document.getElementById("liPresent");
        var ongletAbsent = document.getElementById("liAbsent");
        tabcontent = document.getElementsByClassName("fonctions");
        
        if (checkBox.checked == true){
          pageName = "Present";
          ongletAbsent.classList.remove("active"); /*update les onglets*/
          ongletPresent.classList.add("active");
        }else{
          pageName = "Absent";
          ongletPresent.classList.remove("active");
          ongletAbsent.classList.add("active");
        }
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none"; //hide all
        }
        document.getElementById(pageName).style.display = "grid"; //disp selected       
    }
    if (document.getElementById("switchPresence").checked == false) {
      document.getElementById("switchPresence").click(); /*Permet d'update le switch lors d'un rafraichissement*/
    }
  </script>
   

</body>

</html>
