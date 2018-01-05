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
	//Elimino pagina
	if (isset($_REQUEST['id'])){
		$id_pagina=intval($_REQUEST['id']);
		if ($delete=mysqli_query($con,"delete from paginas where id_pagina='$id_pagina'")){
			$message= "Datos eliminados satisfactoriamente";
		} else {
			$error= "No se pudo eliminar los datos";
		}
	}
	
	$titulo=mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	
	$tables=" paginas, user ";
	$sWhere=" paginas.autor=user.user_id and paginas.titulo LIKE '%$titulo%'";
	
	$sWhere.=" order by paginas.id_pagina desc";
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
				
				<td>Título</td>
				<td>Autor</td>
				<td>Slug</td>
				<td>Estado</td>
				<td>Fecha</td>
				<td></td>
			</tr>
			<?php
				while($row = mysqli_fetch_array($query)){
					$id_pagina=$row['id_pagina'];
					$titulo=$row['titulo'];
					$autor=$row['nombres']." ".$row['apellidos'];
					$slug=$row['slug'];
					$estado=$row['estado'];
					if ($estado==1){
						$label_estado="Publicada";
					} else {
						$label_estado="No publicada";
					}
					$date=$row['fecha'];
					$fecha=date('d/m/Y', strtotime($date));
					
					?>
					<tr>
						
						<td><?php echo $titulo;?></td>
						<td><?php echo $autor;?></td>
						<td>page/<?php echo $slug;?></td>
						<td><?php echo $label_estado;?></td>
						<td><?php echo $fecha;?></td>
						<td class="text-right">
						<a href="pageedit.php?id=<?php echo intval($id_pagina);?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Editar</a>
						<?php if ($id_pagina>4){?>
						<a href='#' onclick="eliminar_pagina('<?php echo $id_pagina;?>')" title='Borrar página'class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
						<?php  }?>
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
