<?php

	session_start();

	if(isset($_SESSION["idusuario"]) && $_SESSION["mnu_mantenimiento"] == 1){

		if ($_SESSION["superadmin"] != "S") {
			include "view/header.html";
			include "view/Tipo_Pago.html";
		} else {
			include "view/headeradmin.html";
			include "view/Tipo_Pago.html";
		}

		include "view/footer.html";
	} else {
		header("Location:index.html");
	}
		

