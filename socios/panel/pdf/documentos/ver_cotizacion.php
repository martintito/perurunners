<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	ob_start();
	
	// include the configs / constants for the database connection
	include("../../../config/conexion.php");
	// load the login class
	require_once("../../classes/Login.php");
	$login = new Login();
	if ($login->isUserLoggedIn() == false) 
	{
		//No tiene permiso entonces no muestro nada
		exit;
	}
	
	$id_cotizacion= intval($_GET['id']);

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		

	$sql_cotizacion=mysqli_query($con, "select * from cotizaciones, clientes, productos where productos.id_producto=cotizaciones.id_producto and cotizaciones.id_cliente=clientes.id_cliente and cotizaciones.id='".$id_cotizacion."' ");
	$rwC=mysqli_fetch_array($sql_cotizacion);
	$numero_cotizacion=$rwC['id'];	
	$fecha_cotizacion=date('d/m/Y', strtotime($rwC['fecha']));
	$atencion=$rwC['nombres'];
	$email=$rwC['email'];
	$cantidad=$rwC['cantidad'];
	$nombre_producto=$rwC['nombre_producto'];
	$modelo_producto=$rwC['modelo_producto'];
	$precio=$rwC['precio'];
	$precio_total=$cantidad * $precio;
	$img=$rwC['img'];
	$total_descuento=$rwC['total_descuento'];
	$note=$rwC['note'];
	$terms=$rwC['terms'];
	$validity=$rwC['validity'];
	$delivery=$rwC['delivery'];
	
    // get the HTML
     
     include(dirname('__FILE__').'/res/ver_cotizacion_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Cotizacion.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
