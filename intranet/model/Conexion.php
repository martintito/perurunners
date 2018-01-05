<?php

	$conexion = new mysqli("localhost", "root", "1234", "perurunners_com");
	//$conexion = new mysqli("localhost", "root", "", "perurunners_com");
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
		echo 'error de conexion';
	    exit();
	}
