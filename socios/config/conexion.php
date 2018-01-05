<?php
$DB_HOST="mysql.perurunners.com";
$DB_NAME= "perurunners_com";
$DB_USER= "perurunnerscom";
$DB_PASS= "XCENgZrZ";
	# conectare la base de datos
    $con=@mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
/*DATOS DE LA EMPRESA*/
	function get_data($table,$row,$equal){
		global $con; 
		$query=mysqli_query($con,"select $row from $table where id='$equal'");
		$rw=mysqli_fetch_array($query);
		$data=$rw[$row];
		return $data;
	}
	function about_info(){
		global $con;
		$query=mysqli_query($con,"select descripcion from paginas where id_pagina=1");
		$row=mysqli_fetch_array($query);
		$descripcion=$row['descripcion'];
		$substr=substr($descripcion,0,100);
		return strip_tags($substr);
	}
	$business_name=get_data("business_profile","name",1);
	$business_address=get_data("business_profile","address",1);
	$business_phone=get_data("business_profile","phone",1);
	$business_owner="";
	$business_email=get_data("business_profile","email",1);
	$business_logo_url=get_data("business_profile","logo_url",1);
	$business_url_base=get_data("business_profile","url_base",1);
	$business_timezone_id=get_data("business_profile","timezone_id",1);
	$business_currency_id=get_data("business_profile","currency_id",1);
	$business_currency_symbol=get_data("currencies","symbol",$business_currency_id);
	$business_timezone_name=get_data("timezones","name",$business_timezone_id);
	$business_latitud=get_data("business_profile","latitud",1);
	$business_longitud=get_data("business_profile","longitud",1);
	/*FINAL DATOS DE LA EMPRESA*/	

	date_default_timezone_set($business_timezone_name);

?>
