function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

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
    elmnt.classList.toggle("active");

}