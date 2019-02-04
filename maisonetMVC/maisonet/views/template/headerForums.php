<head>
    <meta charset="utf-8">
    <title>User Interface</title>

    <link rel="stylesheet" href="views/forum/forum.css"<!--feuille css-->
    <link rel="icon" href="Images-forum/favicon.png"> <!--icone-->

    <script type="text/javascript" src="views/forum/forumScripts.js"></script>

</head>

<body>

<img class="avatar" src="Images-forum/avatar.png" onclick="openNav()"> </img>
<div id="mySidenav" class="sidenav">
    <a href="javascript:closeNav()" class="closebtn">&times;</a>
    <!-- la croix pour fermer -->
    <a href="#">Profil</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
    <a href="index.php?action=logout">Déconnexion</a>
</div>

<picture class="logo">
    <source media="(max-width: 480px)" srcset="Images-forum/logo_provisoire2.png">
    <source srcset="Images-forum/logo_provisoire2.png">
    <img src="Images-forum/logo_provisoire2.png"/>
</picture>