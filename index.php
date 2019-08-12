<?php
    require_once "header.php";
    if(!isset($_SESSION['uLoggedIn']) || $_SESSION['uLoggedIn'] == 0)
    {
        require_once "login.php";
    }
    else
    {
        // if logged in -- WHATS THE PURPOSE OF AN INDEX PAGE???
        echo "<div class=\"container\">
                <pre>
                This is the index page. Here is nothing cool so far.
                Any Ideas? Tell me.
                </pre>
            </div>
";
    }
?>

<main>

</main>
<?php
    require_once "footer.php";
?>