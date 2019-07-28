<?php
    if(isset($_GET['tbxUsername']))
    {
        require_once "dbh.inc.php";
        $uName = $_GET['tbxUsername'];

        $sql = sprintf("UPDATE tbluser SET uLevel = 2 WHERE uName = '%s'", $uName);
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($result === true)
        {
            header("Location: ../usercontrol.php?success=makeadmin&username=".$uName);
            exit();
        }
        else
        {
            header("Location: ../index.php?error=makeadmin");
            exit();
        }
    }
    else
    {
        header("Location: ../index.php");
        exit();
    }



