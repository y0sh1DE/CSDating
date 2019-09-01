<?php
    require_once "header.php";
?>

<html>
    <div class="container">
        <table class="table">
            <tbody>
                <tr>
                    <td>
                        <img src="avatars/-1.png" alt="avatar" height="400" width="400"/>
                    </td>
                    <td>
                        <label for="tbxUsername">Username</label>
                        <input type="text" value="Yoshi" id="tbxUsername" name="tbxUsername" class="form-control" disabled>
                        <hr>
                        <label for="tbxUsername">Last Seen at</label>
                        <input type="text" value="2019-08-28 20:13:52" name="tbxLastSeen" id="tbxLastSeen" class="form-control" disabled>
                        <hr>
                        <label for="tbxUsername">Dating Entries</label>
                        <input type="text" value="20" name="tbxDatingEntries" id="tbxDatingEntries" class="form-control" disabled>
                        <hr>
                        <label for="tbxUsername">Teamspeak Status</label><br><br>
                        <img src="https://userb.tsviewer.com/1_t-i_cn-000000_ct1-A5A5A5_ct2-585858_cson-60B404_csof-E00101_cgs-FFFFFF_cge-F2F2F2_cl-757575/Ft85u94sMy1Ij1X3RhpHGKyq6iY%3D.png" alt="tsStatus">
                    </td>
                </tr>
                <tr>
                    <td>
                        <form method="post" action="includes/saveProfile.inc.php" name="frmSaveProfile" id="frmSaveProfile">
                        <label for="imgAvatarUpload">Avatar</label><br>
                        <input name="imgAvatarUpload" id="imgAvatarUpload" type="file" accept="image/png">
                    </td>
                </tr>
                <tr>
                    <td>
                            <input class="btn btn-primary" value="Save Profile" name="btnSaveProfile" id="btnSaveProfile" type="submit">
                            <input class="btn btn-secondary" value="Reset" name="btnReset" id="btnReset" type="reset">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</html>


<?php
    require_once "footer.php";
?>
