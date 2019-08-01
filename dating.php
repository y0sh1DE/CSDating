<?php
    require_once "header.php";
    if($_SESSION['uLoggedIn'] == 0)
    {
        header("Location: index.php?error=notloggedin");
        exit();
    }
?>
<html>
    <div class="container">
        Hier ensteht bald die Datingplattform.
    </div>
</html>
<?php
require_once "footer.php";
?>