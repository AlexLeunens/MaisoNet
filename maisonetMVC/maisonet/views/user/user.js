/* import jQuery */
var script = document.createElement('script');

script.src = '//code.jquery.com/jquery-1.11.0.min.js';
document.getElementsByTagName('head')[0].appendChild(script);


var modal = document.getElementById("ajoutCapteur");

// Get the button that opens the modal
var btn = document.getElementById("addCapteur");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];


// When the user clicks on the button, open the modal
btn.onclick = function () {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


var piece = document.getElementsByClassName("piece");
var panel = document.getElementsByClassName('panel'); //selec piece et panel
for (var i = 0; i < piece.length; i++) { //pour tout bouton
    piece[i].onclick = function () {
        var setClasses = !this.classList.contains('active'); //selec classes actives qui ne sont pas celle sur laquelle on clique
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

function toggle_visibility(id) {
    var e = document.getElementById(id);
    if (e.style.display == 'block')
        e.style.display = 'none';
    else
        e.style.display = 'block';
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

function tabFAQ() {
    var win = window.open("views/FAQ/FAQ.php", '_blank');
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
    document.getElementById("switchPresence").click(); // Update le switch lors d'un rafraichissement
}