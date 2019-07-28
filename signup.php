<?php
require_once "header.php";
?>
    <main>
        <div class="container">
            <h2>Sign Up</h2>
            <form action="includes/signup.inc.php" method="post" name="frmSignUp">
                <div class="form-group">
                    <input type="text" name="tbxUsername" placeholder="Username" required minlength="4">
                </div>
                <div class="form-group">
                    <input type="password" name="tbxPassword" placeholder="Password" required>
                    <input type="password" name="tbxPasswordRepeat" placeholder="Repeat Password" required>
                </div>
                <div class="form-group">
                    <button name="btnSignUp" type="submit" class="btn btn-outline-primary">Sign up</button>
                    <button type="button" class="btn btn-link"><a href="index.php">Got an account already? Login instead!</a></button>
                </div>
            </form>
        </div>
    </main>

<?php
require "footer.php";
?>