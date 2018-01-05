<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	# conectare la base de datos
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	# obtengo la zona horaria registrada en la db
	function get_timezone(){
		global $con,$timezone;
		$sql=mysqli_query($con, "select timezones.name from business_profile, timezones where business_profile.timezone_id=timezones.id and business_profile.id=1");	
		$rw=mysqli_fetch_array($sql);
		$timezone_name=$rw['name'];
		$timezone=date_default_timezone_set($timezone_name);
		return $timezone;
	}
	get_timezone();

	
?>
