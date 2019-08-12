<?php
    if(isset($_POST['btnSignUp']))
    {
        require_once "dbh.inc.php";

        $username = $_POST["tbxUsername"];
        $password = $_POST["tbxPassword"];
        $passwordrepeat = $_POST["tbxPasswordRepeat"];

        if($password !== $passwordrepeat)
        {
            header("Location: ../signup.php?error=invalidPasswordRepeat&tbxUsername=".$username);
            exit();
        }
        else
        {
            // check for existing name already
            $query = "SELECT uID FROM tblUser WHERE uName = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $query))
            {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            else
            {
                // no sql error happend
                mysqli_stmt_bind_param($stmt, "s",$username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0)
                {
                    // username is taken
                    header("Location: ../signup.php?error=usernametaken");
                    exit();
                }
                else
                {
                    // user is ready to get inserted
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    require_once "config.inc.php";
                    $sql = "";
                    if($GLOBALS['SIGNUP_MODE'] == 1)
                    {
                        $sql = sprintf("INSERT INTO tbluser (uName, uPassword, uRegistered, uLastLogin, uLastAddress, uLevel) VALUES ('%s','%s', current_timestamp(), current_timestamp(), '%s', 0)", $username, $hashedPwd, $_SERVER['REMOTE_ADDR']);
                    }
                    else if($GLOBALS['SIGNUP_MODE'] == 2)
                    {
                        $sql = sprintf("INSERT INTO tbluser (uName, uPassword, uRegistered, uLastLogin, uLastAddress, uLevel) VALUES ('%s','%s', current_timestamp(), current_timestamp(), '%s', 1)", $username, $hashedPwd, $_SERVER['REMOTE_ADDR']);
                    }
                    else die("ERROR IN SIGN UP");

                    if(mysqli_query($conn, $sql))
                    {
                        // Insert succeeded
                        if($GLOBALS['SIGNUP_MODE'] == 1)
                        {
                            header("Location: ../login.php?success=signup&username=". $username);
                            exit();
                        }
                        else
                        {
                            header("Location: ../login.php?success=signupInstant&username=". $username);
                            exit();
                        }

                    }
                    else
                    {
                        // failure during insert
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    }

                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else
    {
        header("Location: ../signup.php");
        exit();
    }