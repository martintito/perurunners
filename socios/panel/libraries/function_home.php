<?php
function count_customers(){
	global $con;
	$sql=mysqli_query($con,"select COUNT(*) as count from clientes ");
	$rw=mysqli_fetch_array($sql);
	echo $count=number_format($rw['count'],0);
} 

function count_products(){
	global $con;
	$sql=mysqli_query($con,"select COUNT(*) as count from productos where id_fabricante>0 ");
	$rw=mysqli_fetch_array($sql);
	echo $count=number_format($rw['count'],0);
}

function count_products_status($status){
	global $con;
	$sql=mysqli_query($con,"select COUNT(*) as count from productos where id_fabricante>0 and status_producto='$status'");
	$rw=mysqli_fetch_array($sql);
	echo $count=number_format($rw['count'],0);
} 

function new_customers(){
	global $con;
	$year=date('Y');
	$month=date('m');
	$sql=mysqli_query($con,"select COUNT(*) as count from clientes where year(agregado) = '$year' and month(agregado)= '$month' ");
	$rw=mysqli_fetch_array($sql);
	echo $count=$rw['count'];
}
function count_quotes(){
	global $con;
	$sql=mysqli_query($con,"select COUNT(*) as count from cotizaciones");
	$rw=mysqli_fetch_array($sql);
	echo $count=$rw['count'];
}
function count_quotes_status($status){
	global $con;
	$sql=mysqli_query($con,"select COUNT(*) as count from cotizaciones where estado='$status'");
	$rw=mysqli_fetch_array($sql);
	echo $count=$rw['count'];
}
function quotes_month($year, $month, $status){
	global $con;
	$sql=mysqli_query($con,"select COUNT(*) as count from cotizaciones where year(fecha) = '$year' and month(fecha)= '$month' and estado='$status'");
	$rw=mysqli_fetch_array($sql);
	 $count=$rw['count'];
}