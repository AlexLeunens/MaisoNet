<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>User Interface</title>

  <link rel="stylesheet" href="FAQ.css"> <!--feuille css-->
  <link rel="icon" href="Images//favicon.png"> <!--icone-->
  
</head>

<body>

<h1> FAQ :</h1>

<picture class ="logo">
    <source media="(max-width: 480px)" srcset="Images/logoBlackWhiteMini.png">
    <source srcset="Images/logoBlackWhite.png">
    <img src="Images/logoBlackWhite.png"/>
</picture>

<div class="row">
  <div class="Menu">
    <h2>Menu</h2>
    <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
    <ul id="myMenu">
      <li><a id="defaultOpen" href="javascript:openPage('Utilisation', this)">Utilisation</a></li>
      <li><a href="javascript:openPage('Paiement', this)">Paiement</a></li>
      <li><a href="javascript:openPage('Profil', this)">Profil</a></li>
      <li><a href="javascript:openPage('Assistance', this)">Assistance</a></li>
      <li><a href="javascript:openPage('Température', this)">Température</a></li>
      <li><a href="javascript:openPage('Volets', this)">Volets</a></li>
      <li><a href="javascript:openPage('Lumieres', this)">Lumieres</a></li>
      <li><a href="javascript:openPage('Alarmes', this)">Alarmes</a></li>
    </ul>
  </div>

 <div id="Utilisation" class="Elements">
    <h2>Utilisation</h2>
    <p>Guide d'utilisation</p>
  </div>

  <div id="Paiement" class="Elements">
    <h2>Paiement</h2>
    <p>Différents moyens de paiement et facturation</p>
  </div>

  <div id="Profil" class="Elements">
    <h2>Profil</h2>
    <p>Aide sur le profil et le menu du profil</p>
  </div>

  <div id="Assistance" class="Elements">
    <h2>Assistance</h2>
    <div> 
    <p>Comment contacter de l'aide en cas de besoin</p>
 </div>
  </div>

  <div id="Température" class="Elements">
    <h2>Température</h2>
    <p>Explications sur les capteurs de température et de leur contrôle</p>
  </div>

  <div id="Volets" class="Elements">
    <h2>Volets</h2>
    <p>Explications sur le contrôle des volets</p>
  </div>

  <div id="Lumieres" class="Elements">
    <h2>Lumieres</h2>
    <p>explications sur le contrôle des lumières</p>
  </div>

  <div id="Alarmes" class="Elements">
    <h2>Alarmes</h2>
    <p>Explications sur le système d'alarmes</p>
  </div>


</div>

<script>
function myFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("mySearch");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myMenu");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
function openPage(pageName,elmnt) {
    var i, elements;
    elements = document.getElementsByClassName("Elements");
    for (i = 0; i < elements.length; i++) {
        elements[i].style.display = "none";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.classList.toggle("focus");
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>