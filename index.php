<?php
    require_once "header.php";
    if(!isset($_SESSION['uLoggedIn']))
    {
        require_once "login.php";
    }
    else if($_SESSION['uLoggedIn'] == 0)
    {
        require_once "login.php";
    }
    else
    {
        require_once "dating.php";
    }
?>

<main>
    <!-- DEFAULT LANDING PAGE -->
</main>

<?php
    require_once "footer.php";
?>