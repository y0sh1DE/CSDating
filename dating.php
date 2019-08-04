<?php
    require_once "header.php";
    if($_SESSION['uLoggedIn'] == 0)
    {
        header("Location: index.php?error=notloggedin");
        exit();
    }
?>
<html>
    <div class="container">
        <div class="form-row">
            <div class="col">
            <form action="includes/submitTime.inc.php" method="get" id="frmSetTime">
                <div class="form-group">
                    <label for="selTime">Which day do you want to set your time for?</label>
                    <select class="form-control" id="selDate" name="selDate">
                        <?php
                            require_once "includes/config.inc.php";
                            for($days = 0; $days < $GLOBALS['MAX_DAYS_AHEAD'];$days++)
                            {
                                $daysSTR = sprintf("+%s Days", $days);
                                $output = sprintf("<option>%s</option>", date("d.m.y", strtotime($daysSTR)));
                                echo $output;
                            }
                        ?>
                    </select>
                    <label for="selTime">When are you ready for Counter-Strike?</label>
                    <select class="form-control" id="selTime" name="selTime">
                        <option>Not at all</option>
                        <option>16:00</option>
                        <option>16:15</option>
                        <option>16:30</option>
                        <option>16:45</option>
                        <option>17:00</option>
                        <option>17:15</option>
                        <option>17:30</option>
                        <option>17:45</option>
                        <option>18:00</option>
                        <option>18:15</option>
                        <option>18:30</option>
                        <option>18:45</option>
                        <option>19:00</option>
                        <option>19:15</option>
                        <option>19:30</option>
                        <option>19:45</option>
                        <option>20:00</option>
                        <option>20:15</option>
                        <option>20:30</option>
                        <option>20:45</option>
                        <option>21:00</option>
                        <option>21:15</option>
                        <option>21:30</option>
                        <option>21:45</option>
                        <option>22:00</option>
                        <option>22:15</option>
                        <option>22:30</option>
                        <option>22:45</option>
                        <option>23:00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tbxComment">Comment</label>
                    <textarea class="form-control" name="tbxComment" id="tbxComment" rows="3" maxlength="30"></textarea>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="btnSubmit" id="btnSubmit" value="Submit"/>
                    <input class="btn btn-secondary" type="reset" name="btnReset" id="btnReset" value="Reset"/>
                </div>
            </form>
        </div>
        <div class="col">
            <!-- DATES LIST -->
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nickname</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Set at</th>
                    <th scope="col">Created at</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    require_once "includes/dbh.inc.php";

                    $sql = "SELECT * FROM tbldate2user";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $sql = sprintf("SELECT uName FROM tbluser WHERE uID = '%s'", $row['uID']);
                        $nameresult = mysqli_query($conn, $sql);
                        $nameRow = mysqli_fetch_assoc($nameresult);
                        $uName = $nameRow['uName'];
                        $output = sprintf("
                            <tr>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>     
                                <td>%s</td>                        
                            </tr>                        
                        ", $uName, $row['dDate'], $row['dTime'], $row['uComment'], $row['d2uSet'], $row['d2uCreated']);
                        echo $output;
                    }
                ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</html>
<?php
require_once "footer.php";
?>