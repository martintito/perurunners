<?php
session_start();
if(!isset($_SESSION["login_posv"]))
{
echo "<script>location.replace('login.php');</script>";
exit;
}

/* Llamar la Cadena de Conexion*/ 
include ("../../config/conexion.php");
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	//Elimino producto
	if (isset($_REQUEST['id'])){
		$id=intval($_REQUEST['id']);
		
		if ($delete=mysqli_query($con,"delete from cotizaciones where id='$id'")){
				$message= "Datos eliminados satisfactoriamente";
			} else {
				$error= "No se pudo eliminar los datos";
			}
		
	}
	
	//Actualiza valores de la cotizaciones
	if (isset($_REQUEST['id_cotizacion'])){
		$id_cotizacion=intval($_REQUEST['id_cotizacion']);
		$valor=floatval($_REQUEST['valor']);
		$tipo=intval($_REQUEST['tipo']);
		if ($tipo==1){$condicion="cantidad='".$valor."'";}
		else if ($tipo==2){$condicion="precio='".$valor."'";}
		else if ($tipo==3){$condicion="total_descuento='".$valor."'";}
		$update=mysqli_query($con,"update cotizaciones set $condicion where id='$id_cotizacion'");

		
	}
	
	$q=mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$tables="clientes,cotizaciones , productos";
	$sWhere=" (clientes.nombres LIKE '%$q%' or clientes.email like '%$q%') and cotizaciones.id_cliente=clientes.id_cliente and productos.id_producto=cotizaciones.id_producto";
	$sWhere.=" order by cotizaciones.id desc";
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = 10; //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query))
	{
	$numrows = $row['numrows'];
	}
	else {echo mysqli_error($con);}
	$total_pages = ceil($numrows/$per_page);
	$reload = './userslist.php';
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT * FROM  $tables where $sWhere LIMIT $offset,$per_page");
	
	if (isset($message)){
		?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>Aviso!</strong> <?php echo $message;?>
		</div>
		
		<?php
	}
	if (isset($error)){
		?>
		<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>Error!</strong> <?php echo $error;?>
		</div>
		
		<?php
	}
	//loop through fetched data
	if ($numrows>0)	{
		?>
		<div class="table-responsive">
		  <table class="table">
			<tr>
				<td>#</td>
				<td>Cliente</td>
				<td>Fecha</td>
				<td>Producto</td>
				<td>Estado</td>
				<td class='text-right'>Cantidad</td>
				<td class='text-right'>Precio Unit.</td>
				<td class='text-right'>Descuento</td>
				<td class='text-right'>Total</td>
				
				<td></td>
			</tr>
			<?php
				while($row = mysqli_fetch_array($query)){
					$id=$row['id'];
					$nombres=$row['nombres'];
					$telefono=$row['telefono'];
					$email=$row['email'];
					$date=$row['fecha'];
					$fecha=date("d/m/Y", strtotime($date));
					$nombre_producto=$row['nombre_producto'];
					$modelo_producto=$row['modelo_producto'];
					$cantidad=$row['cantidad'];
					$precio=$row['precio'];
					$total_descuento=number_format($row['total_descuento'],2,'.','');
					$precio_total=($precio * $cantidad) - $total_descuento;
					$estado=$row['estado'];
					
					if ($estado==0){$text_estado="Pediente";$label_class="label-warning";}
					else if ($estado==1){$text_estado="Aceptada";$label_class="label-success";}
					else if ($estado==2){$text_estado="Rechazada";$label_class="label-danger";}
					else{ $text_estado=""; }
					?>
					<tr>
						<td><?php echo $id;?></td>
						<td>
							<?php echo $nombres;?><br>
							<?php echo $telefono;?><br>
							<?php echo $email;?>
						</td>
						<td><?php echo $fecha;?></td>
						<td>
							<?php echo $nombre_producto;?><br>
							<small class='text-muted'><?php echo $modelo_producto;?></small>
						</td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado;?></span></td>
						<td class='col-xs-1'>
							<div class="pull-right">
								<input type="number" class="form-control input-sm" style="text-align:right" id="cantidad_<?php echo $id; ?>" onblur="actualiza_cotizacion('<?php echo $id;?>',this.value,this.id,1)"  placeholder="USD" maxlength="8" value="<?php echo intval($cantidad);?>">
							</div>
						</td>
						<td class='col-xs-1'>
							<div class="pull-right">
								<input type="text" class="form-control input-sm" style="text-align:right" id="precio_<?php echo $id; ?>" onblur="actualiza_cotizacion('<?php echo $id;?>',this.value,this.id,2)"  placeholder="USD" maxlength="8" value="<?php echo number_format($precio,2,'.','');?>">
							</div>
						</td>
						<td class='col-xs-1'>
							<div class="pull-right">
								<input type="text" class="form-control input-sm" style="text-align:right" id="descuento_<?php echo $id; ?>" onblur="actualiza_cotizacion('<?php echo $id;?>',this.value,this.id,3)"  placeholder="USD" maxlength="8" value="<?php echo $total_descuento;?>">
							</div>
						</td>
						<td class='text-right'><?php echo number_format($precio_total,2);?></td>
						<td class="text-right "> 
						<!-- Single button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Acciones <span class="caret"></span>
						  </button>
						  <ul class="dropdown-menu pull-right">
							<li><a href="quotesedit.php?id=<?php echo $id;?>" ><span class="glyphicon glyphicon-edit"></span> Editar</a></li>
							<li><a href="#" onclick="descargar('<?php echo $id;?>');"><span class="glyphicon glyphicon-download"></span> Descargar</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#" onclick="eliminar('<?php echo $id;?>')"><span class="glyphicon glyphicon-trash"></span> Eliminar</a></li>
							
						  </ul>
						</div>
						
						</td>
					</tr>
					<?php
				}
			?>
		  </table>
		</div>
		<div class="table-pagination text-right">
			
			<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
		</div>
		<?php
	}
}
?>
