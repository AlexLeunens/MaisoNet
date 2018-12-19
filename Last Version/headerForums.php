<head>
    <meta charset="utf-8">
    <title>User Interface</title>

    <link rel="stylesheet" href="forum.css"> <!--feuille css-->
    <link rel="icon" href="Images//favicon.png"> <!--icone-->

    <script type="text/javascript" src="forumScripts.js"></script>

</head>

<body>

<img class="avatar" src="Images/avatar.png" onclick="openNav()"> </img>
<div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a>
    <!-- la croix pour fermer -->
    <a href="#">Profil</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
    <a href="#">Déconnexion</a>
</div>

<picture class="logo">
    <source media="(max-width: 480px)" srcset="Images/logo_provisoire2.png">
    <source srcset="Images/logo_provisoire2.png">
    <img src="Images/logo_provisoire2.png"/>
</picture>