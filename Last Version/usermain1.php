<!doctype html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title>User Interface</title>

    <link rel="stylesheet" href="usermain.css"> <!--feuille css-->
   <link rel="icon" href="Images-utilisateur/logo_provisoire_mini.png"> <!--icone-->
  
</head>

<body>

  <img class="avatar" src="Images-utilisateur/avatar.png" onclick="openNav()"> </img>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a> <!-- la croix pour fermer -->
    <a href="Nos_services.php">Services</a>
    <a href="" onclick= "popupContact()" >Contact</a>
    <a href="index.php">Déconnexion</a>
  </div>




  <div id="menu">  <!--conteneur-->
    <img id="logo" src="Images-utilisateur/logo_provisoire2.png"> </img>

    <ul id="onglets">  <!--commence la liste et lui donne l'id onglet-->
      <li id="liPresent" class="active"><a href="javascript:switchClick()"> Mode Présence </a></li>
      <li id="liAbsent"><a href="javascript:switchClick()"> Mode Absence </a></li>
      <p id="switchText"> Mode Présence </p>

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
				<img class="imagestemperature" src="Images-utilisateur/temperature+.png" alt="temperature"></img>
				<p class=sstitre>Votre Temperature</p></a>
				</div>
				<div class="bloc"><a href="#masquevolet">
				<img class="imagesbutton" src="Images-utilisateur/volet.png" alt="volets"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
			</div>

		<p class="piece">Chambre 1</p>
			<div class="panel">
				<div class="bloc"><a href="#masquetemp">
				<img class="imagestemperature" src="Images-utilisateur/temperature+.png" alt="temperature"></img>
				<p class=sstitre>Votre Temperature</p></a>
				</div>
				<div class="bloc"><a href="#masquevolet">
				<img class="imagesbutton" src="Images-utilisateur/volet.png" alt="volets"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
			</div>

		<p class="piece">Salle A Manger</p>
			<div class="panel">
				<div class="bloc"><a href="#masquetemp">
				<img class="imagestemperature" src="Images-utilisateur/temperature+.png" alt="temperature"></img>
				<p class=sstitre>Votre Temperature</p></a>
				</div>
				<div class="bloc"><a href="#masquevolet">
				<img class="imagesbutton" src="Images-utilisateur/volet.png" alt="volets"></img>
				<p class=sstitre>Etat volet</p></a>
				</div>
			</div>
      </div>


  <div id= "Absent" class="fonctions" style="display:none;">
    <p class="piece">Economies</p>
    <div class="panel">
    </div>


    <p class="piece">Sécurité</p>
     <div class="panel">
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

