<?php

	$output = shell_exec("echo 'zeuszeus2020!' | sudo -u minecraft -S /home/minecraft/mcserver/start.sh start");
	header("Location: ../index.php?msg=startedMC");
	exit();
