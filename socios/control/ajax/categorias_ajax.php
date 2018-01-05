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
		$id_categoria=intval($_REQUEST['id']);
		//Verifica que no sea una categoria_padre
		$sql_parent=mysqli_query($con,"SELECT * FROM categorias where parent='$id_categoria'");
		$count_parent=mysqli_num_rows($sql_parent);
		$sql_prod=mysqli_query($con,"SELECT * FROM productos where id_categoria='$id_categoria'");
		$count_prod=mysqli_num_rows($sql_prod);
		
		$error=null;
		if ($count_parent>0){
		$error= "No se puede eliminar una categoría padre.";
		} 
		if ($count_prod>0){
		$error= "No se puede eliminar ésta categoría.";
		}
		if ($error==null){
			if ($delete=mysqli_query($con,"delete from categorias where id_categoria='$id_categoria'")){
				$message= "Datos eliminados satisfactoriamente";
			} else {
				$error= "No se pudo eliminar los datos";
			}
		}
	}
	
	$nombre_categoria=mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$tables="categorias";
	$sWhere=" categorias.nombre_categoria LIKE '%$nombre_categoria%' and parent=0";
	$sWhere.=" order by categorias.nombre_categoria ";
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
	$reload = './categorylist.php';
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
				<td>Id</td>
				<td>Nombre Categoría</td>
				<td>Nº Productos</td>
				
				<td></td>
			</tr>
			<?php
				while($row = mysqli_fetch_array($query)){
					$id_categoria=$row['id_categoria'];
					$nombre_categoria=$row['nombre_categoria'];
					$parent=$row['parent'];
					if ($id_categoria!=0){
						$sql_cat=mysqli_query($con,"select nombre_categoria from categorias where id_categoria='$parent'");
						$rw_parent=mysqli_fetch_array($sql_cat);
						$categoria_padre=$rw_parent['nombre_categoria'];
					}else {$categoria_padre="";}
					$sql_productos=mysqli_query($con,"SELECT count(*) AS productos_nums FROM productos, categorias where productos.id_categoria=categorias.id_categoria and parent='$id_categoria'");
					$rw_product=mysqli_fetch_array($sql_productos);
					$numero_productos=$rw_product["productos_nums"];
					
					$sql2=mysqli_query($con,"select * from categorias where parent='$id_categoria' order by nombre_categoria");
					$count2=mysqli_num_rows($sql2);
					if ($count2>0){
						?>
						<tr class=''>
							<td><?php echo $id_categoria;?></td>
							<td><strong><?php echo $nombre_categoria;?></strong></td>
							
							<td><strong><?php echo number_format($numero_productos,2);?></strong></td>
							
							<td>
							<a href="categoryedit.php?id=<?php echo intval($id_categoria);?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Editar</a>
							<a href='#' onclick="eliminar_categoria('<?php echo $id_categoria;?>')" title='Borrar categoría'class ="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
							</td>
						</tr>
						<?php
						while ($row2=mysqli_fetch_array($sql2)){
							$id2=$row2['id_categoria'];
							$nombre2=$row2['nombre_categoria'];
							$sql_productos=mysqli_query($con,"SELECT count(*) AS productos_nums FROM productos where id_categoria='$id2'");
							$rw_product=mysqli_fetch_array($sql_productos);
							$numero_productos=$rw_product["productos_nums"];
						?>
						<tr>
							<td><?php echo $id2;?></td>
							<td><?php echo "&nbsp;&nbsp;&nbsp; ".$nombre_categoria." > ".$nombre2;?></td>
							
							<td><?php echo number_format($numero_productos,2);?></td>
							
							<td>
							<a href="categoryedit.php?id=<?php echo intval($id2);?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Editar</a>
							<a href='#' onclick="eliminar_categoria('<?php echo $id2;?>')" title='Borrar categoría' class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
							</td>
						</tr>
						<?php
						}
					} else{
						$sql_productos=mysqli_query($con,"SELECT count(*) AS productos_nums FROM productos where id_categoria='$id_categoria'");
							$rw_product=mysqli_fetch_array($sql_productos);
							$numero_productos=$rw_product["productos_nums"];
						?>
						<tr class=''>
							<td><?php echo $id_categoria;?></td>
							<td><strong><?php echo $nombre_categoria;?></strong></td>
							
							<td><strong><?php echo number_format($numero_productos,2);?></strong></td>
							
							<td>
							<a href="categoryedit.php?id=<?php echo intval($id_categoria);?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Editar</a>
							<a href='#' onclick="eliminar_categoria('<?php echo $id_categoria;?>')" title='Borrar categoría'class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
							</td>
						</tr>
						<?php
					}
					?>
					
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
