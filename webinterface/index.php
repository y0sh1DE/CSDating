<html>
<head>
<?php
	require_once "header.php";
?>
    <meta charset="utf-8"/>
    <title> Conies Homies Webinterface </title>
  </head>
  <body>
  <div class="container">
		<?php
			if(isset($_GET['msg']))
			{
				echo "<div class='alert alert-primary' role='alert'>";
				switch($_GET['msg'])
				{
					case "startedMC":
					{
						echo "Started Minecraft Server!";
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
	      <button class="btn btn-primary" type="submit" name="btnStartTW">Starte Teeworlds Server</button>
	    </form>
	    <form action="scripts/script.startMC.php" name="frmStartMC" method="post">
		<button class="btn btn-primary" type="submit" name"btnStartMC">Starte Minecraft Server</button>
	    </form>
	    <form action="scripts/script.rebootVM.php" name="frmRestartVM" method="post">
		<button class="btn btn-primary" type="submit" name="rebootVM">Reboote die komplette VM</button>
	    </form>
		</div>
  </body>
</html>
