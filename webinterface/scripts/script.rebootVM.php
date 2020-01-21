<?php

	$output = shell_exec('/sbin/shutdown');
	header("Location: ../index.php?msg=restartedVM");
	exit();
