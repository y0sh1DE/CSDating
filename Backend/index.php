<?php

?>

<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style type="text/css">
            body { background: cadetblue !important; }
        </style>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <style>
            .vl {
                border-left: 60px solid cadetblue;
                height: 500px;
            }
        </style>
        <script type="text/javascript">
            function goBack()
            {
                document.getElementById("frmNewsletter").action = "../index.php";
                document.getElementById("frmNewsletter").submit();
            }
            function refresh()
            {
                window.location.href = "index.php";
            }
            function error(msg)
            {
                let errorBox = document.getElementById("errorBox");
                errorBox.style = "display: ''";
                errorBox.innerHTML = msg;
            }
            function validate()
            {
                let subject = document.getElementById("tbxSubject").value;
                let message = document.getElementById("tbxMessage").value;
                if(message == "" || subject == "")
                {
                    error("Missing data!");
                }
                else document.getElementById("frmNewsletter").submit();
            }
        </script>
    </head>
    <body>
        <div class="container">
            <br>
            <div id="errorBox" class="alert alert-danger" role="alert" style="display: none">
            </div>
            <?php
                if(isset($_GET["success"]))
                {
                    echo "
                    <br><div class=\"alert alert-success\" role=\"alert\">
                      Newsletter sent!
                    </div>
                    ";
                }
                require_once "../includes/dbh.inc.php";
                $sql = "SELECT COUNT(*) AS 'count' FROM tbluser";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $output = sprintf("<h3>Receipents: %s</h3>", $row['count']);
                echo $output;
            ?>
            <hr>
            <div class="form-row">
                <div class="form-col">
                    <form action="sendLetter.inc.php" method="post" class="form" id="frmNewsletter">
                        <div class="form-group">
                            <label for="tbxSubject">Subject</label>
                            <input type="text" class="form-control" id="tbxSubject" aria-describedby="tbxSubject">
                            <small id="subjectHelp" class="form-text text-muted">This text will appear in the subject line of your Newsletter.</small>
                        </div>
                        <div class="form-group">
                            <label for="tbxMessage">Message</label>
                            <textarea class="form-control" id="tbxMessage" rows="10"></textarea>
                        </div>
                        <button type="button" onclick="validate()" class="btn btn-success">Send Newsletter</button>
                        <button type="button" onclick="refresh()" class="btn btn-secondary">Reset</button>
                        <button type="button" onclick="goBack()" class="btn btn-danger">Back to CSDating</button>
                    </form>
                </div>
                <div class="vl"></div>
                <div class="form-col">
                    <small>(None of them are working by now)</small>
                    <table class="table">
                        <thead>
                            <th scope="col">Placeholder</th>
                            <th scope="col">Description</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{USERNAME}</td>
                                <td>The Username of the user</td>
                            </tr>
                            <tr>
                                <td>{USERMAIL}</td>
                                <td>The Mail Address of the user</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
