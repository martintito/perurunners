<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	//Inicia Control de Permisos
	include("../config/permisos.php");
	$user_id = $_SESSION['user_id'];
	get_cadena($user_id);
	$modulo="Fabricantes";
	permisos($modulo,$cadena_permisos);
	//Finaliza Control de Permisos
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	//Elimino producto
	if (isset($_REQUEST['id'])){
		$id=intval($_REQUEST['id']);
		//Verifica que no existen productos con el fabricante 
		$sql_prod=mysqli_query($con,"SELECT * FROM productos where id_fabricante='$id'");
		$count_prod=mysqli_num_rows($sql_prod);
		$error=null;
		 
		if ($count_prod>0){
		$error= "No se puede eliminar éste fabricante. Existen producto asignados al fabricante";
		}
		if ($error==null){
			if ($delete=mysqli_query($con,"delete from fabricantes where id_fabricante='$id'")){
				$message= "Datos eliminados satisfactoriamente";
			} else {
				$error= "No se pudo eliminar los datos";
			}
		}
	}
	
	$nombre_fabricante=mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$tables="fabricantes";
	$sWhere=" fabricantes.nombre_fabricante	 LIKE '%$nombre_fabricante%'";
	$sWhere.=" order by fabricantes.id_fabricante desc";
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
				<td>Logo</td>
				<td>Nombre Fabricante</td>
				<td>Nº Productos</td>
				
				<td></td>
			</tr>
			<?php
				while($row = mysqli_fetch_array($query)){
					$id_fabricante=$row['id_fabricante'];
					$nombre=$row['nombre_fabricante'];
					$logo_url=$row['logo_url'];
					$sql_productos=mysqli_query($con,"SELECT count(*) AS productos_nums FROM productos where id_fabricante='$id_fabricante'");
					$rw_product=mysqli_fetch_array($sql_productos);
					$numero_productos=$rw_product["productos_nums"];
					?>
					<tr>
						<td><?php echo $id_fabricante;?></td>
						<td><img src="../img/marcas/<?php echo $logo_url;?>" width="100"></td>
						<td><?php echo $nombre;?></td>
						<td><?php echo number_format($numero_productos,2);?></td>
						
						<td>
						<?php 
						if ($permisos_editar==1){
						?>
							<a href="manufactureredit.php?id=<?php echo intval($id_fabricante);?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Editar</a>
						<?php }?>
						<?php 
						if ($permisos_eliminar==1){
						?>	
							<a href='#' onclick="eliminar_fabricante('<?php echo $id_fabricante;?>')" title='Borrar fabricante'class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
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
