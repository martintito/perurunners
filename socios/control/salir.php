<?php
//Iniciamos Sesion
Session_Start();
//Destruimos la Sesion
unset($_SESSION["login_posv"]);
//Se redirecciona a login
header("location:login.php");
?>