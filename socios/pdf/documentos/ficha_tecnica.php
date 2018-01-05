<?php
/**
 * HTML2PDF Library - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
    ob_start();
	/*INICIO DATOS*/
		include("../../config/conexion.php");
		//Variables por GET
		$id=$_GET['id_producto'];
		$id=intval($id);
		//Fin de variables por GET
		$sql_producto="select * from productos where id_producto='$id' and status_producto!=0";
		$query_producto=mysqli_query($con,$sql_producto);
		$nums=mysqli_num_rows($query_producto);
		if ($nums==0){
			exit;
		}
		while ($row=mysqli_fetch_array($query_producto)){
			$id_producto=$row["id_producto"];	
			$nombre_producto=$row["nombre_producto"];
			$id_fabricante=$row["id_fabricante"];
			$modelo=$row["modelo_producto"];
			$id_fabricante=$row['id_fabricante'];
			$decripcion=$row["descripcion_producto"];
			$img=$row["img"];
		}
	/*FIN DATOS*/
	
    include(dirname(__FILE__).'/res/ficha_html.php');
    $content = ob_get_clean();
    // convert in PDF
    require_once(dirname(__FILE__).'/../vendor/autoload.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(1, 1, 1, 1));
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Cotizacion_'.$id.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }