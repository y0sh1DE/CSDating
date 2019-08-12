<?php
    require_once "header.php";
?>
<div class="container">
    <h2>Login</h2>
    <form action="includes/login.inc.php" method="post">
        <div class="form-group">

            <input type="text" name="tbxUsername" placeholder="Username" required minlength="4" value="<?php if(isset($_GET['username'])) echo $_GET['username']; ?>">
        </div>
        <div class="form-group">
            <input type="password" name="tbxPassword" placeholder="Password" required>
        </div>
        <div class="form-group">
            <button name="btnLogin" type="submit" class="btn btn-outline-primary">Login</button>
            <?php
                require_once "includes/config.inc.php";
                if($GLOBALS['SIGNUP_MODE'] != 0)
                {
                    echo "<button type=\"button\" class=\"btn btn-link\"><a href=\"signup.php\">No Account yet? Sign up!</a></button>";
                }
            ?>
        </div>
    </form>
</div>