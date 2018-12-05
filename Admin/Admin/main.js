
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
