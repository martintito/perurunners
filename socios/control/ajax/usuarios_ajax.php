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
		if ($id!=1){
		if ($delete=mysqli_query($con,"delete from user where user_id='$id'")){
				$message= "Datos eliminados satisfactoriamente";
			} else {
				$error= "No se pudo eliminar los datos";
			}
		} else {
		$error= "El usuario administrador no puede ser borrado.";	
		}
	}
	
	$username=mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$tables="user";
	$sWhere=" user.username LIKE '%$username%'";
	$sWhere.=" order by user.user_id desc";
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
				<td>Id</td>
				<td>Nombres</td>
				<td>Email</td>
				<td>Estado</td>
				
				<td></td>
			</tr>
			<?php
				while($row = mysqli_fetch_array($query)){
					$user_id=$row['user_id'];
					$nombres=$row['nombres'];
					$apellidos=$row['apellidos'];
					$fullname="$nombres $apellidos";
					$username=$row["username"];
					$status=$row["status"];
					if ($status==1){$lbl="Activo";}
					else {$lbl="Inactivo";}
					
					?>
					<tr>
						<td><?php echo $user_id;?></td>
						<td><?php echo $fullname;?></td>
						<td><?php echo $username;?></td>
						<td><?php echo $lbl;?></td>
						
						<td>
						<a href="usersedit.php?id=<?php echo intval($user_id);?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Editar</a>
						<a href='#' onclick="eliminar_usuario('<?php echo $user_id;?>')" title='Borrar usuario' class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
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
