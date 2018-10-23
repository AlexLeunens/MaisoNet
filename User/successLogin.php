
<?php
    session_start();
      
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']== false){
        header("Location: indexLogin.php");
    

    
    }
?>

<h2> Vous êtes connectés </h2>


