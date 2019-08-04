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
        // if logged in
    }
?>

<main>
    <div class="container">
        <h3>Welcome!</h3>
    </div>
</main>

<?php
    require_once "footer.php";
?>