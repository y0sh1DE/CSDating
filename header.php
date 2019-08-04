<?php
    require_once "includes/config.inc.php";
    session_start();
    setcookie(session_name(),session_id(),time() + $GLOBALS['SESSION_LIFETIME']);
    if(isset($_SESSION['uLoggedIn']) && $_SESSION['uLoggedIn'] == 1)
    {
        require_once "includes/refreshUserinfo.inc.php";
        include_once "whoIsOnline.php";
    }
?>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <title>CSDating V0.4.2</title>
    </head>
    <body>
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a href="index.php"><img style="float:left" height="64" width="64" src="img/Logo.png" alt="Logo"></a>

            <?php
                if(isset($_SESSION['uLoggedIn']))
                {
                    // If user is logged in
                    echo "<li class=\"nav-item\">                
                    <a class=\"nav-link\" href=\"dating.php\">Dating</a>
                </li>";

                    echo "<li class=\"nav-item\">                
                    <a class=\"nav-link disabled\" href=\"mapvoting.php\">Map Voting</a>
                </li>";

                    echo "<li class=\"nav-item\">                
                    <a class=\"nav-link\" href=\"changePassword.php?username=".$_SESSION['uName']."\">Change Password</a>
                </li>";

                    echo "<li class=\"nav-item\">
                            <a class=\"nav-link disabled\" href=\"\">Logged in as: ".$_SESSION['uName']."</a>
                        </li>
                        </li>";
                }
                if(isset($_SESSION['uLevel']) && $_SESSION['uLevel'] == 2)
                {
                    // Display Admin Area
                    echo "<li class=\"nav-item\">                
                    <a class=\"nav-link\" href=\"usercontrol.php\" style='color:red'>Usercontrol</a>
                </li>";
                }
            ?>
        </ul>
        <h1>CS-Dating by Yoshi</h1>
        <hr>
        <?php

            if(isset($_GET['error']))
            {
                switch ($_GET['error'])
                {
                    case "sqlerror":
                    {
                        echo"<div class=\"alert alert-danger\" role=\"alert\">
                          Intern SQL Error happend!
                        </div>";
                        break;
                    }
                    case "usernametaken":
                    {
                        echo"<div class=\"alert alert-danger\" role=\"alert\">
                          Your username is already taken!
                        </div>";
                        break;
                    }
                    case "wrongpwd":
                    {
                        echo"<div class=\"alert alert-danger\" role=\"alert\">
                          Wrong username or password!
                        </div>";
                        break;
                    }
                    case "permission":
                    {
                        echo"<div class=\"alert alert-danger\" role=\"alert\">
                          You dont have permission to enter this site!
                        </div>";
                        break;
                    }
                    case "invalidPasswordRepeat":
                    {
                        echo"<div class=\"alert alert-danger\" role=\"alert\">
                         Passwords dont match!
                        </div>";
                        break;
                    }
                    case "notaccepted":
                    {
                        echo"<div class=\"alert alert-danger\" role=\"alert\">
                         Your Account still has to be accepted by an Administrator!
                        </div>";
                        break;
                    }
                    default:
                    {
                        echo"<div class=\"alert alert-danger\" role=\"alert\">
                         Not handled Error Message: ". $_GET['error'] . "
                        </div>";
                        break;
                    }
                }
            }
            else if(isset($_GET['success']))
            {
                switch($_GET['success'])
                {
                    case "setdate":
                    {
                        echo"<div class=\"alert alert-primary\" role=\"alert\">
                          Successfully set your arrival time!
                        </div>";
                        break;
                    }
                    case "updatedate":
                    {
                        echo"<div class=\"alert alert-primary\" role=\"alert\">
                          Successfully updated your arrival time!
                        </div>";
                        break;
                    }
                    case "usercreated":
                    {
                        echo"<div class=\"alert alert-primary\" role=\"alert\">
                          Successfully created ". $_GET['username'] . "!<br>
                          Password: ". $_GET['password']."
                        </div>";
                        break;
                    }
                    case "makeadmin":
                    {
                        echo"<div class=\"alert alert-primary\" role=\"alert\">
                          Successfully made ". $_GET['username'] . " an Admin!
                        </div>";
                        break;
                    }
                    case "promoted":
                    {
                        echo"<div class=\"alert alert-primary\" role=\"alert\">
                          Successfully promoted ". $_GET['username']."
                        </div>";
                        break;
                    }
                    case "signup":
                    {
                        echo"<div class=\"alert alert-primary\" role=\"alert\">
                          Successfully signed up!<br>
                          An Administrator now has to accept your registration.
                        </div>";
                        break;
                    }
                    case "login":
                    {
                        echo"<div class=\"alert alert-primary\" role=\"alert\">
                          Welcome back ". $_SESSION["uName"] . "! 
                        </div>";
                        break;
                    }
                    case "logout":
                    {
                        echo"<div class=\"alert alert-primary\" role=\"alert\">
                          Successfully logged out! 
                        </div>";
                        break;
                    }
                    case "delDeclined":
                    {
                        echo"<div class=\"alert alert-primary\" role=\"alert\">
                          Successfully deleted all declined Accounts! 
                        </div>";
                        break;
                    }
                    default:
                    {
                        echo"<div class=\"alert alert-primary\" role=\"alert\">
                          Unhandled success message: ".$_GET['success']."
                        </div>";
                        break;
                    }
                }
            }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>