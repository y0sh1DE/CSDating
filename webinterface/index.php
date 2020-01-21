<?php
	require_once "header.php";
?>
<html>
  <head>
    <meta charset="utf-8"/>
    <title> Conies Homies Webinterface </title>
  </head>
  <body bgcolor="grey">
  <br>
	<?php
		if(isset($_GET['msg']))
		{
			echo "<div class='alert alert-primary' role='alert'>";
			switch($_GET['msg'])
			{
				case "startedMC":
				{
					echo "Started Minecraft Server!!";
					break;
				}
				case "restartedVM":
				{
					echo "Will restart the VM now... hopefully";
					break;
				}
				default:
					echo $_GET['msg'];
			}
			echo "</div>";
		}
	?>
    <form action="scripts/script.startTW.php" name="frmStartTW" method="post">
      <button type="submit" name="btnStartTW">Starte Teeworlds Server</button>
    </form>
    <form action="scripts/script.startMC.php" name="frmStartMC" method="post">
	<button type="submit" name"btnStartMC">Starte Minecraft Server</button>
    </form>
    <form action="scripts/script.rebootVM.php" name="frmRestartVM" method="post">
	<button type="submit" name="rebootVM">Reboote die komplette VM</button>
    </form>
  </body>
</html>