<?php
if(isset($_SESSION['uLoggedIn']))
{
    echo"
    <div class='container'><form action=\"includes/logout.inc.php\" method=\"post\">
        <button name=\"btnLogout\" type=\"submit\" class=\"btn btn-outline-dark\">Logout</button>
    </form></div>";
}