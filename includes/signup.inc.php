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
                    $sql = sprintf("INSERT INTO tbluser (uName, uPassword) VALUES ('%s','%s')", $username, $hashedPwd);
                    if(mysqli_query($conn, $sql))
                    {
                        // Insert succeeded
                        header("Location: ../login.php?success=signup");
                    }
                    else
                    {
                        // failure during insert
                        header("Location: ../signup.php?error=sqlerror");
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