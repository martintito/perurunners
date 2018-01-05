<?php
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
if (isset($_GET['id'])){
	$id=intval($_GET['id']);
	$query=mysqli_query($con,"select * from newsletter where id='$id'");
	$rw=mysqli_fetch_array($query);
	$nombres=$rw['nombres'];
	$apellidos=$rw['apellidos'];
	$email=$rw['email'];

	
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
		  <li><a href="subscriberslist.php">Suscriptores</a></li>
		  <li class="active">Editar</li>
		</ol>
		 <div class="col-md-6">
		 
			<form class="form-horizontal" id="editar_suscriptores">
				 
			  <div class="form-group">
				<label for="nombres" class="col-sm-4 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $nombres;?>">
				  <input type="hidden" value="<?php echo $id;?>" id="id" name="id">		
				</div>
			  </div>

			  <div class="form-group">
				<label for="apellidos" class="col-sm-4 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos;?>">
				 </div>
			  </div>
			  <div class="form-group">
				<label for="email" class="col-sm-4 control-label">Correo electrónico</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>" required>
				 </div>
			  </div>
			 
			  <div class="form-group">
			  <div id='loader'></div>
			  <div class='outer_div'></div>
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success">Actualizar datos</button>
				</div>
			  </div>
			</form>
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
		$("#editar_suscriptores").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/editar_suscriptor.php",
				  type: "POST",
				  data: $("#editar_suscriptores").serialize(),
				   beforeSend: function(objeto){
					$("#loader").html("Cargando...");
				  },
				  success:function(data){
						$(".outer_div").html(data).fadeIn('slow');
						$("#loader").html("");
					}
			});
			 e.preventDefault();
		});
	</script>

