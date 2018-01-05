<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo $_SERVER['SERVER_NAME']." "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="../../../img/logo.png" alt="Logo"><br>
                
            </td>
			<td style="width: 75%;text-align:right;font-size:18px;">
				COTIZACION Nº <?php echo $numero_cotizacion;?>
			</td>
			
        </tr>
    </table>
    <hr>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
		<td style="width:50%; ">
		<strong>Dirección:</strong> <br><?php echo $business_address;?><br> 
		Teléfono:<?php echo $business_phone;?> </td>
		
		</tr>
	</table>
	
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
		<tr>
			<td style="width: 100%;text-align:right">
			Fecha: <?php echo $fecha_cotizacion;?>
			</td>
		</tr>
	</table>
	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           
            <td style="width:15%; ">Atención:</td>
            <td style="width:50%"><?php echo $atencion; ?> </td>
			
        </tr>
        
        <tr>
            
            <td style="width:15%; ">Email:</td>
            <td style="width:50%"><?php echo $email; ?></td>
        </tr>
   <br>
    </table>
    
        <table cellspacing="0" style="width: 100%; text-align: left;font-size: 11pt">
        <tr>
             <td style="width:100%; ">A continuación Presentamos nuestra oferta que esperamos sea de su conformidad.</td>
        </tr>
    </table>
  
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;padding:1mm;">
        <tr>
            <th style="width: 10%">CANT.</th>
            <th style="width: 60%">DESCRIPCION</th>
            <th style="width: 15%">PRECIO UNIT.</th>
            <th style="width: 15%">PRECIO TOTAL</th>
            
        </tr>
    </table>

	<table cellspacing="0" style="width: 100%; border: solid 1px black;  text-align: center; font-size: 11pt;padding:1mm;">
        <tr>
            <td style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td style="width: 60%; text-align: left">
				<?php echo $nombre_producto;?><br>
				<small><?php echo $modelo_producto;?></small><br>
				<img src="../../../<?php echo $img;?>"  style="width: 80%;">
			</td>
            <td style="width: 15%; text-align: right"><?php echo number_format($precio,2);?></td>
            <td style="width: 15%; text-align: right"><?php echo number_format($precio_total,2);?></td>
            
        </tr>
    </table>
	<?php 
		
			$total=$precio_total-$total_descuento;		
		
	?>

    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;padding:2mm;">
	<?php 
		if ($total_descuento>0){
	?>
        <tr>
			
            <th colspan=2 style="width: 87%; text-align: right;">SUB-TOTAL $</th>
            <th style="width: 13%; text-align: right;"><?php echo number_format($precio_total,2);?></th>
        </tr>
        <tr>
            <th colspan=2 style="width: 87%; text-align: right;">DESCUENTO $</th>
            <th style="width: 13%; text-align: right;"><?php echo number_format($total_descuento,2);?></th>
        </tr>  
	<?php 
		}
	?>	
		<tr>
			<th style="width: 50%; text-align: left;"><?php echo $note;?></th>
            <th style="width: 37%; text-align: right;">TOTAL $</th>
            <th style="width: 13%; text-align: right;"><?php echo number_format($total,2);?></th>
        </tr>
    </table>

	<br>
	<p>
	Condiciones de pago: <?php echo $terms;?><br>
	Validez de la oferta: <?php echo $validity;?><br>
	Tiempo de entrega: <?php echo $delivery;?>
	</p>
	
	  <table cellspacing="10" style="width: 100%; text-align: left; font-size: 11pt;">
			 <tr>
                <td style="width:33%;text-align: center;border-top:solid 1px"><?php echo $business_owner;?><br>Asesor de venta</td>
               <td style="width:33%;text-align: center;border-top:solid 1px">Cotizado</td>
               <td style="width:33%;text-align: center;border-top:solid 1px">Aceptado Cliente</td>
            </tr>
        </table>
</page>

