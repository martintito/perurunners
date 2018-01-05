<?php
if (!file_exists ('config/db.php')){
		header("location: install/paso1.php");
		exit;
	}
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}
// include the configs / constants for the database connection
require_once("config/db.php");
// load the login class
require_once("classes/Login.php");
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();
	// ... ask if we are logged in here:
/*	if ($login->isUserLoggedIn() == true) 
	{	*/
	if (isset($_SESSION["idusuario"])) 
	{
		/* Connect To Database*/
		require_once ("config/conexion.php");
		/* function_home*/
		require_once ("libraries/function_home.php");
		
		
		//Inicia Control de Permisos
		include("./config/permisos.php");
		$_SESSION['user_id'] = 1;
		$_SESSION['name_session']="ispcontrol_admin";
		$_SESSION['full_name'] = $_SESSION['empleado'];
		$_SESSION['user_name'] = $_SESSION['empleado'];
        $_SESSION['user_email'] = '';
        $_SESSION['user_login_status'] = 1;
		$user_id = $_SESSION['user_id'];
		//$user_id = 1;
		get_cadena($user_id);
		$modulo="Inicio";
		permisos($modulo,$cadena_permisos);
		//Finaliza Control de Permisos
		$title="Panel de control | Catalogo Web";
		$pageheader_title="Inicio";
		$pageheader_icon="fa fa-home";
		$pageheader_breadcrumb="";
		$home=1;
		
		include('view/home.php');//Include file with the view
	}
	else
	{
		header("location: login.php");
		exit;		
	}
?>

