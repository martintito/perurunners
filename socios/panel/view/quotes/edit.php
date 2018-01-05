<?php
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
if (isset($_GET['id'])){
	$id_cotizacion=intval($_GET['id']);
	$query=mysqli_query($con,"select * from cotizaciones, clientes, productos where cotizaciones.id_producto=productos.id_producto and cotizaciones.id_cliente=clientes.id_cliente and cotizaciones.id='$id_cotizacion'");
	$rw=mysqli_fetch_array($query);
	$nombres_cliente=$rw['nombres'];
	$email_cliente=$rw['email'];
	$status=$rw['estado'];
	$terms=$rw['terms'];
	$validity=$rw['validity'];
	$delivery=$rw['delivery'];
	$note=$rw['note'];
	$codigo_producto=$rw['codigo_producto'];
	$cantidad_producto=$rw['cantidad'];
	$price=$rw['precio'];
	$total_price=$price*$cantidad_producto;
	$total_descuento=$rw['total_descuento'];
	$total=	$total_price- $total_descuento;
	$nombre_producto=$rw['nombre_producto'];
	$quote_date= date('d/m/Y', strtotime($rw['fecha']));
	
}else {
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("view/head.php");?>
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <div class="leftpanel">
	<?php include("view/leftpanel.php");?>
  </div><!-- leftpanel -->
  
  <div class="mainpanel">
    
    <div class="headerbar">
		<?php include("view/headerbar.php"); ?>
    </div><!-- headerbar -->
    
    <div class="pageheader">
      <?php include("view/pageheader.php");?>
    </div>
    
    <div class="contentpanel">
      <?php if ($permisos_editar==1){?>
		<section class="content-header">
			<div class="row">
				<ol class="breadcrumb">
				  <li><a href="productslist.php">Inicio</a></li>
				  <li><a href="quoteslist.php">Cotizaciones</a></li>
				  <li class="active">Editar</li>
				</ol>
							 
				<!-- *********************** Quote ************************** -->
				<div class="panel panel-default">
					  <div class="panel-heading"><h4><i class="glyphicon glyphicon-edit"></i> Editar Cotización</h4></div>
					  <div class="panel-body">
						<form method="post" id="editar_cotizacion">
							<div id="loader"></div> <!-- cargador ajax -->
							<div class="outer_div"></div><!-- datos ajax -->
							<div class="row">
								<div class="col-md-4">
									<label>Cliente</label>
									<select class="form-control" name="customer_id">
										<option value=""><?php echo $nombres_cliente;?> (<?php echo $email_cliente;?>)</option>			
									</select>
									<input type="hidden" value="<?php echo $id_cotizacion;?>" name="id_cotizacion">
								</div>
								<div class="col-md-3">
									<label>Estado de la cotización</label>
									<select class="form-control" name="estado">
										<option value="0" <?php if ($status==0){echo "selected";}?>>Pendiente</option>
										<option value="1" <?php if ($status==1){echo "selected";}?>>Aceptada</option>
										<option value="2" <?php if ($status==2){echo "selected";}?>>Rechazada</option>
									</select>
													
									</select>
								</div>
								<div class="col-md-3">
									<label>Fecha</label>
									<input type="text" class="form-control datepicker" name="purchase_date"  value="<?php echo $quote_date;?>" disabled="">
								</div>
								<div class="col-md-2">
									<label>Cotización Nº</label>
									<input type="text" class="form-control" value="<?php echo $id_cotizacion; ?>" readonly>
								</div>
								<div class="col-md-4">
									<label>Garantía</label>
									<input type="text" class="form-control" name="garantia" value="<?php echo $note;?>" maxlength="100" required >
								</div>
								
								<div class="col-md-3">
									<label>Condiciones de pago</label>
									<input type="text" class="form-control" name="condiciones" value="<?php echo $terms;?>" maxlength="100" required>
								</div>
								<div class="col-md-3">
									<label>Validez de la oferta</label>
									<input type="text" class="form-control" name="validez" value="<?php echo $validity;?>" maxlength="100" required>
								</div>
								<div class="col-md-2">
									<label>Tiempo de entrega</label>
									<input type="text" class="form-control" name="entrega" value="<?php echo $delivery;?>" maxlength="100" required>
								</div>
								
								
								
							</div>
							<hr>
							<div class="row">
								<table class="table table-hover">
									<tr>
										<td>CODIGO</td>
										<td>CANT.</td>
										<td>DESCRIPCION</td>
										<td class="text-right">PRECIO UNITARIO</td>
										<td class="text-right">PRECIO TOTAL</td>
									</tr>
									
									<tr>
										<td><?php echo $codigo_producto;?></td>
										<td class='col-md-1'>
											<input type="number"  min="1" class="form-control input-sm" name="cantidad" value="<?php  echo $cantidad_producto;?>" required maxlength="4">
										</td>
										<td><?php echo $nombre_producto;?></td>
										<td class="text-right col-md-2">
											<input type="text" class="form-control input-sm" name="precio" value="<?php  echo number_format($price,2,'.','' );?>" style="text-align:right" required pattern="\d+(\.\d{2})?">
										</td>
										<td class="text-right"><?php echo number_format($total_price,2);?></td>
									</tr>
									<tr>
										<td class="text-right" colspan="4">SUB-TOTAL $</td>
										<td class="text-right"><?php echo number_format($total_price,2);?></td>
									</tr>
									<tr>
										<td class="text-right" colspan="4">DESCUENTO $</td>
										<td class="text-right col-md-1" ><input type="text" class="form-control input-sm" name="descuento" value="<?php echo number_format($total_descuento,2,'.','');?>" style="text-align:right" ></td>
									</tr>
									<tr>
										<td class="text-right" colspan="4">TOTAL $</td>
										<td class="text-right"><?php echo number_format($total,2);?></td>
									</tr>
								</table>
							</div>
							<div class="pull-right">
								<button type="submit" class="btn btn-primary">Actualizar datos</button>
							</div>	
						</form>
					  </div>
				</div>				
             </div>
				
			 
        </section>
		 <!-- Main content -->

     
      <?php 
	  } 
	  else
	  {
		include("view/access_denied.php");
	  }
	  ?>
    </div><!-- contentpanel -->
    
  </div><!-- mainpanel -->
  

  
  
</section>


<?php
include ("view/js.php")
?>

</body>
</html>
<script>
		$("#editar_cotizacion").submit(function(e) {
			$.ajax({
				  url: "ajax/editar_cotizacion.php",
				  type: "POST",
				  data: $("#editar_cotizacion").serialize(),
				   beforeSend: function(objeto){
					$("#loader").html("Cargando...");
				  },
				  success:function(data){
						$(".outer_div").html(data).fadeIn('slow');
						$("#loader").html("");
					}
			});
				window.setTimeout(function() {
						$(".alert").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						location.reload();
						});}, 5000);
			 e.preventDefault();
		});	
	</script>