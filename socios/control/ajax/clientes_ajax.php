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
		$sql_cot=mysqli_query($con,"select * from cotizaciones where id_cliente='$id'");
		$count=mysqli_num_rows($sql_cot);
		if ($count==0){
		if ($delete=mysqli_query($con,"delete from clientes where id_cliente='$id'")){
				$message= "Datos eliminados satisfactoriamente";
			} else {
				$error= "No se pudo eliminar los datos";
			}
		} else {
		$error= "El cliente no puede ser eliminado. Existen cotizaciones vinculadas a este cliente.";	
		}
	}
	
	$q=mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$tables="clientes";
	$sWhere=" (clientes.nombres LIKE '%$q%' or clientes.email like '%$q%')";
	$sWhere.=" order by clientes.id_cliente desc";
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
				<td>Teléfono</td>
				<td>Email</td>
				<td>Agregado</td>
				
				<td></td>
			</tr>
			<?php
				while($row = mysqli_fetch_array($query)){
					$id_cliente=$row['id_cliente'];
					$nombres=$row['nombres'];
					$telefono=$row['telefono'];
					$email=$row['email'];
					$agregado=$row['agregado'];
					$fecha=date("d/m/Y", strtotime($agregado));
					
					?>
					<tr>
						<td><?php echo $id_cliente;?></td>
						<td><?php echo $nombres;?></td>
						<td><?php echo $telefono;?></td>
						<td><?php echo $email;?></td>
						<td><?php echo $fecha;?></td>
						
						<td class="text-right"> 
						<a href="customersedit.php?id=<?php echo intval($id_cliente);?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Editar</a>
						<a href='#' onclick="eliminar_cliente('<?php echo $id_cliente;?>')" title='Borrar cliente' class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
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
