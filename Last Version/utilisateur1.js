var piece = document.getElementsByClassName("piece");
var panel = document.getElementsByClassName('panel'); //selec piece et panel
for (var i = 0; i < piece.length; i++) { //pour tout bouton
    piece[i].onclick = function () {
        var setClasses = !this.classList.contains('active'); //selec classes actives qui ne sont pas celle sur laquelle on a cliqué
        setClass(piece, 'active', 'remove'); //les rend inactives
        setClass(panel, 'show', 'remove'); // cache le contenu
        if (setClasses) {
            this.classList.toggle("active"); //rend celle cliquée active (piece)
            this.nextElementSibling.classList.toggle("show"); //affiche le contenu (panel)
        }
    }
}

$(document).on("click", "p.piece", function () {
    var a = !this.classList.contains("active");
    setClass(piece, "active", "remove");
    setClass(panel, "show", "remove");
    a && (this.classList.toggle("active"), this.nextElementSibling.classList.toggle("show"));
});


var help = document.getElementsByClassName("help")
var helpPanel = document.getElementsByClassName("helpPanel")
help[0].onclick = function () {
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

function switchClick() {
    document.getElementById("switchPresence").click();
}

function openPage(elmnt) {
    var i, tabcontent, pageName, ongletActif;
    var checkBox = document.getElementById("switchPresence");
    var ongletPresent = document.getElementById("liPresent");
    var ongletAbsent = document.getElementById("liAbsent");
    tabcontent = document.getElementsByClassName("fonctions");

    if (checkBox.checked == true) {
        pageName = "Present";
        ongletAbsent.classList.remove("active"); /*update les onglets*/
        ongletPresent.classList.add("active");
    } else {
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

function closeShit() {
    document.getElementById("garbage").style.display = "none";
}