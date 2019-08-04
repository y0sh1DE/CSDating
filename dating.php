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
                    <label for="selTime">Which day are you talking about?</label>
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
                    <label for="selTime">When are you ready for CS?</label>
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
                    <textarea class="form-control" name="tbxComment" id="tbxComment" rows="3" maxlength="100"></textarea>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="btnSubmit" id="btnSubmit" value="Submit"/>
                    <input class="btn btn-secondary" type="reset" name="btnReset" id="btnReset" value="Reset"/>
                </div>
            </form>
        </div>
        <div class="col">
            <!-- DATES LIST -->

        </div>
        </div>
    </div>
</html>
<?php
require_once "footer.php";
?>