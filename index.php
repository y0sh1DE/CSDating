<?php
    require_once "header.php";
     if(!isset($_SESSION['uLoggedIn']))
     {
        require_once "login.php";
     }
     else
     {
         require_once "dating.php";
     }
?>

<main>

</main>

<?php
    require_once "footer.php";
?>