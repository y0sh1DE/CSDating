<?php
    require_once "header.php";
    if($_SESSION['uLevel'] != 2)
    {
        header("Location: index.php?error=permission");
        exit();
    }
    ?>

<html>

    <!-- CONTENT -->
    <div class="container">
        <form action="includes/delDeclined.inc.php">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete all declined Accounts?');">Delete all declined Accounts</button>
        </form>
    </div>

</html>

<?php
    require_once "footer.php";
?>
