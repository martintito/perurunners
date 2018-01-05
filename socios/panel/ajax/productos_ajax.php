<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	//Inicia Control de Permisos
	include("../config/permisos.php");
	$user_id = $_SESSION['user_id'];
	get_cadena($user_id);
	$modulo="Productos";
	permisos($modulo,$cadena_permisos);
	//Finaliza Control de Permisos
	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	//Elimino producto
	if (isset($_REQUEST['id'])){
		$id_producto=intval($_REQUEST['id']);
		if ($delete=mysqli_query($con,"delete from productos where id_producto='$id_producto'")){
			$message= "Datos eliminados satisfactoriamente";
		} else {
			$error= "No se pudo eliminar los datos";
		}
	}
	//Actualiza estado del producto
	if (isset($_REQUEST['id_producto']) and isset($_REQUEST['estado'])){
		$id_producto=$_REQUEST['id_producto'];
		$estado=$_REQUEST['estado'];
		$update=mysqli_query($con,"update productos set status_producto='$estado' where id_producto='$id_producto' ");
	}
	//Actualiza show_price del producto
	if (isset($_REQUEST['id_producto']) and isset($_REQUEST['show_price'])){
		$id_producto=$_REQUEST['id_producto'];
		$show_price=$_REQUEST['show_price'];
		$update=mysqli_query($con,"update productos set show_price='$show_price' where id_producto='$id_producto' ");
	}
	$codigo=mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$fab=intval($_REQUEST['id_fab']);
	$cat=intval($_REQUEST['cat']);
	$tables=" productos, categorias, fabricantes";
	$sWhere=" productos.id_categoria=categorias.id_categoria and productos.id_fabricante=fabricantes.id_fabricante";
	$sWhere.=" and productos.codigo_producto LIKE '%$codigo%'";
	if ($fab>0){
	$sWhere.=" and productos.id_fabricante='$fab'";
	}
	if ($cat>0){
	$sWhere.=" and productos.id_categoria='$cat'";
	}
	$sWhere.=" order by productos.id_producto desc";
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
	$reload = './productslist.php';
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
				
				<td>Imagen</td>
				<td>Código</td>
				<td>Modelo</td>
				<td>Producto</td>
				<td>Fabricante</td>
				<td>Categoría</td>
				<td>Estado</td>
				<td>Precio</td>
				<td>Oferta</td>
				<td></td>
			</tr>
			<?php
				while($row = mysqli_fetch_array($query)){
					$id_producto=$row['id_producto'];
					$tumb=$row['tumb'];
					$img=$row['img'];
					$codigo_producto=$row['codigo_producto'];
					$modelo_producto=$row['modelo_producto'];
					$nombre_producto=$row['nombre_producto'];
					$nombre_fabricante=$row['nombre_fabricante'];
					$status_producto=$row['status_producto'];
					$nombre_categoria=$row["nombre_categoria"];
					$price=$row['price'];
					$show_price=$row['show_price'];
					$price_offer=$row['price_offer'];
				
					?>
					<tr>
						
						<td><img src="../<?php echo $img;?>" width="100" ></td>
						<td><?php echo $codigo_producto;?></td>
						<td><?php echo $modelo_producto;?></td>
						<td><?php echo $nombre_producto;?></td>
						<td><?php echo $nombre_fabricante;?></td>
						<td><?php echo $nombre_categoria;?></td>
						<td>
							<select class="form-control input-sm" onchange="cambiar_estado('<?php echo $id_producto ?>',this.value);">
								<option value="0" <?php if ($status_producto==0){echo "selected";}?>>Inactivo</option>
								<option value="1" <?php if ($status_producto==1){echo "selected";}?>>En Stock</option>
								<option value="2" <?php if ($status_producto==2){echo "selected";}?>>Disponible</option>
							</select>
						</td>
						<td>
							<label>
								<input type="checkbox" id="show_price_<?php echo $id_producto;?>" <?php if ($show_price==1){echo "checked";}?> onclick="show_price('<?php echo $id_producto;?>');">
								<?php echo number_format($price,2);?>
							</label>
							
						</td>
						<td><?php echo number_format($price_offer,2);?></td>
						<td>
						<?php 
						if ($permisos_editar==1){
						?>
							<a href="productsedit.php?id=<?php echo intval($id_producto);?>"><span class="glyphicon glyphicon-edit"></span></a>
						<?php }?>
						<?php 
						if ($permisos_eliminar==1){
						?>						
							<a href='#' onclick="eliminar_producto('<?php echo $id_producto;?>')" title='Borrar producto'><span class="glyphicon glyphicon-trash"></span></a>
						<?php }?>	
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
