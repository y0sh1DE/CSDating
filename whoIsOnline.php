<html>
    <head>
        <script>

        </script>
    </head>
    <body>

        <div class="float-sm-left">
            <h3>Who is online?</h3>
            <table class="table" id="tblUserList">
                <thead>
                    <tr>
                        <th scope="col">Nickname</th>
                        <th scope="col">Level</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once "includes/dbh.inc.php";
                        $sql = "SELECT uName, uLevel FROM tbluser WHERE uLoggedIn = 1 AND uLevel >= 1";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $level = "User";
                            if($row['uLevel'] == 2) $level = "Administrator";
                            $out = sprintf("
                            <tr>
                                <td>
                                    %s
                                </td>
                                <td>
                                    %s
                                </td>
                            </tr>", $row['uName'], $level);
                            echo $out;
                        }
                    ?>
                </tbody>
            </table>
        </div>

    </body>
</html>


