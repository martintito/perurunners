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
                    &copy; <?php echo $business_name." ".$anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="../../panel/<?php echo $business_logo_url;?>" alt="Logo"><br>
                
            </td>
			
			
        </tr>
    </table>
    
	<h2><?php echo $nombre_producto; ?></h2>
	<hr>

	<?php 
	if (!empty($img)){
	?>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 10pt;">
        <tr>
           
            <td style="width:50%; ">
			<img style="width: 100%;" src="<?php echo "../../".$img;?>" alt="Logo">
			</td>
			
        </tr>
    </table>
	   <?php 
	}
	   ?>
  

    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: left; font-size: 10pt;padding:1mm;">
        <tr>
            <th style="width: 35%">Ficha Técnica</th>
            <th style="width: 65%"></th>
        </tr>
		
    </table>

    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #fff; text-align: left; font-size: 10pt;padding:2mm;">
       <tr >
            <th style="width: 35%;padding:5px;">Modelo</th>
            <td style="width: 65%; padding:5px;"><?php echo $modelo;?></td>
        </tr>
		<tr >
            <th style="width: 35%;padding:5px;">Fabricante</th>
            <td style="width: 65%; padding:5px;">
				<?php 
				$sql_fabricante=mysqli_query($con,"select nombre_fabricante from fabricantes where id_fabricante='$id_fabricante'");
				$rw_fabricante=mysqli_fetch_array($sql_fabricante);
				echo $rw_fabricante['nombre_fabricante'];
				?>
			</td>
        </tr>
		<?php
			$sql_ficha="select * from ficha_tecnica where id_producto='$id_producto'";
			$query_ficha=mysqli_query($con,$sql_ficha);
			while ($rows_ficha=mysqli_fetch_array($query_ficha)){
			$descripcion_ficha=$rows_ficha["descripcion_ficha"];
			list($head_desc,$body_desc)=explode("||", $descripcion_ficha);
			?>
			<tr>
            <th style="width: 35%;padding:5px;"><?php echo $head_desc;?></th>
            <td style="width: 65%;padding:5px;"><?php echo $body_desc;?></td>
			</tr>
			<?php 
			}			
		?>
    </table>
	
	
	
	

	

</page>

