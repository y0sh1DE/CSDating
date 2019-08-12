<?php
    require_once "header.php";
    if(!isset($_SESSION['uLoggedIn']) || $_SESSION['uLoggedIn'] == 0)
    {
        require_once "login.php";
    }
    else
    {
        // if logged in
    }
?>

<main>
</main>

<?php
    require_once "footer.php";
?>