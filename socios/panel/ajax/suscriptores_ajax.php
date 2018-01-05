<?php
	session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	//Inicia Control de Permisos
	include("../config/permisos.php");
	$user_id = $_SESSION['user_id'];
	get_cadena($user_id);
	$modulo="Suscriptores";
	permisos($modulo,$cadena_permisos);
	//Finaliza Control de Permisos
include ("../../config/conexion.php");
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	//Elimino producto
	if (isset($_REQUEST['id'])){
		$id=intval($_REQUEST['id']);
		if ($delete=mysqli_query($con,"delete from newsletter where id='$id'")){
				$message= "Datos eliminados satisfactoriamente";
			} else {
				$error= "No se pudo eliminar los datos";
			}
		
	}
	
	$email=mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$tables="newsletter";
	$sWhere=" newsletter.email LIKE '%$email%'";
	$sWhere.=" order by newsletter.id desc";
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
	$reload = './subscriberslist.php';
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
				<td>Nombres</td>
				<td>Email</td>
				<td>Agregado</td>
				
				<td></td>
			</tr>
			<?php
				while($row = mysqli_fetch_array($query)){
					$id=$row['id'];
					$nombres=$row['nombres'];
					$apellidos=$row['apellidos'];
					$fullname="$nombres $apellidos";
					$email=$row["email"];
					$fecha_registro=$row["fecha_registro"];
					list($date,$time)=explode(" ",$fecha_registro);
					list($anio, $mes, $dia)=explode("-",$date);
					$fecha="$dia-$mes-$anio";
					?>
					<tr>
						<td><?php echo $id;?></td>
						<td><?php echo $fullname;?></td>
						<td><?php echo $email;?></td>
						<td><?php echo $fecha;?></td>
						
						<td>
						<?php if ($permisos_editar==1){	?>
						<a href="subscribersedit.php?id=<?php echo intval($id);?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Editar</a>
						<?php }?>
						<?php if ($permisos_eliminar==1){	?>
						<a href='#' onclick="eliminar_suscriptor('<?php echo $id;?>')" title='Borrar suscriptor' class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
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
