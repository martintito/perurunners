<?php
/* Llamar la Cadena de Conexion*/ 
include ("../config/conexion.php");
if($_POST && !empty($_POST['usuario']) &&  !empty($_POST['password']) ) {
	//quitamos el posible SQLInjection del usuario
	$usuario = mysqli_real_escape_string($con,(strip_tags($_POST['usuario'], ENT_QUOTES)));
	//sacamos el hash del password para que se compare ya encriptado
	$password = md5(($_POST['password']));
	//vemos si existen registros que coincidan
	$query = mysqli_query($con,"SELECT * FROM user ".
	"WHERE username  = '{$usuario}' AND ".
	"status='1' ");
	if(mysqli_num_rows($query) == 1){
		$row=mysqli_fetch_array($query);
		$password_db=$row["password"];
		$user_id_db=$row["user_id"];
		//compara si el password son lo mismo
		if ($password===$password_db){
			session_start();
			 $_SESSION['user_id_posv'] = $user_id_db;
			 $_SESSION['login_posv'] = $usuario;
			 //todo bien
				header("Location: productslist.php");
				exit;
		}	
		else {  $error="Datos inválidos.";}
	} else {
		$error="Datos inválidos.";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
   <title><?php echo "Login | Proveedores Orientales"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>
 <div class="container">    
        <div id="loginbox" style="margin-top:60px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Inicio de Sesión</div>
                    </div>  
						<?php 
						if (isset($error)){
							?>
						<br>
						<div class="col-sm-12 controls" >
								<div class="alert alert-danger col-sm-12">
								<strong>Error!</strong> <?php echo $error;?>
								</div>  
						</div>
						<?php }?>						
                    <div style="padding-top:30px" class="panel-body" >

                       
                            
                        <form id="loginform" class="form-horizontal" role="form" action="login.php" method="post">
                             		
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input  type="text" class="form-control" name="usuario" id="usuario" value="" placeholder="Usuario" required autofocus>                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                                    </div>
                                    <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">
                                      <button id="btn-login" class="btn btn-success" type="submit">Entrar</button>
                                    </div>
                                </div>
							</form>     
                        </div>                     
                    </div>  
        </div>
</body>
</html>	