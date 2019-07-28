<?php
if(isset($_SESSION['uLoggedIn']))
{
    echo"
    <div class='container'><form action=\"includes/logout.inc.php\" method=\"post\">
        <button name=\"btnLogout\" type=\"submit\" class=\"btn btn-outline-dark\">Logout</button>
    </form></div>";

    require_once "includes/dbh.inc.php";
    if($_SESSION['uLevel'] > 1)
    {
        $sql = "SELECT * FROM tbluser WHERE uLevel = 0";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if($count > 0)
        {
            echo "<script>
            function setAction(element)
            {
                let action = element.name.substring(0,3);
                let uName = element.name.substring(4, element.name.length);
                if(action == \"acc\")
                {
                    document.getElementById(\"frmManagment\").action = \"includes/acceptAccount.inc.php?username=\" + uName;
                    document.getElementById(\"frmManagment\").submit();
                }
                else if(action == \"dec\")
                {
                    document.getElementById(\"frmManagment\").action = \"includes/declineAccount.inc.php?username=\" + uName;
                    document.getElementById(\"frmManagment\").submit();
                }
                else
                {
                    alert(\"Error\");
                }
        
            }
        </script>";
            echo "<form action='includes/acceptAccount.inc.php?username=' method='post' id='frmManagment'>";
            echo"<div class=\"alert alert-primary\" role=\"alert\">
                              There are ". $count . " Accounts waiting for acceptance.<br><br>
                            ";
            while($row = mysqli_fetch_row($result)){

                $uName = $row[1];
                echo $uName . " <button name=\"acc-".$uName."\" type=\"button\" onclick='setAction(this)' class=\"btn btn-success\">Accept</button>";
                echo "<button name=\"dec-".$uName."\" type=\"button\" onclick='setAction(this)' class=\"btn btn-danger\">Decline</button>";
                echo "<hr>";
            }


            echo "</form></div>";
        }
    }
}
?>

