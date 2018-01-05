<?php
include ("header.php");
?>
  <body>
   <!-- Inicio Header-->
   <header>
      <figure id="logo">
        <a href="index.php"><img src="./assets/images/logo.png" class="img-responsive" /></a>
      </figure> 
		<?php
		include ("menuTop.php");
		?>
   <div id="login">
      <a class="btn btn-success" href="registro.php">Registrarse</a>
      <a class="btn btn-primary" href="login.php" >Iniciar Sesion</a>
   </div> <!-- End Login-->
   <hr>
   </header> 
   <!-- Fin Header -->

   <!-- Main --> 
   <section id="main" class="container"> 
   <div class="col-md-9 col-sm-9"> <!-- Col 9-->
      <div id="dashboard" class="row-fluid"> <!-- Dashboard -->
        <div class="col-md-12 col-sm-12">
           <form class="form-signin" action="login.php" method="post">
		   
            <div class="form-signin-heading"> <img src="./assets/images/logo.png" width="300px" heigth="54px" align="center" class="img-responsive"> </div>
            <h3 class="form-signin-heading">Accceso a Miembros</h3>
				  <?php
				  if (isset($_GET["action"]) and isset($_GET["verification_code"]) and $_GET['action']=="activate_account"){
				  $verification_code=base64_decode($_GET["verification_code"]);
				  
				  $upt="UPDATE users SET status=1 where user_email='".addslashes($verification_code)."'";
				  if ($query=mysqli_query($con,$upt)){
					/*Enviar correo electronico al usuario quien lo refirio*/
					
					$sql_user="select * from users where user_email='".addslashes($verification_code)."'";
					$query_user=mysqli_query($con,$sql_user);
					$rw_u=mysqli_fetch_array($query_user);
					$id_padre=$rw_u["parent_id"];
					
					$sql_padre="select * from users where user_id='".addslashes($id_padre)."'";
					$query_padre=mysqli_query($con,$sql_padre);
					$rw_p=mysqli_fetch_array($query_padre);
					$email_padre=$rw_p["user_email"]; 
					$firstname_padre=$rw_p["firstname"]; 
					
				//SEND MAIL DATOS
				$correo_info="soporte@globalicom.com";
				$company_name="Globalicom";
				$Subject="Programa de afiliados en $company_name";
				$message.="============================================ \n\n";
				$message .= "Estimad@ $firstname_padre, \n";//Inicio del mensaje que se enviara al correo
				$message.="A uno de sus referidos se le acaba de aprobar la cuenta en ".$company_name."\n\n";
				$message .= "Si usted tiene alguna pregunta, por favor, responda a ".$correo_info."\n";
				$message .= "Gracias, El equipo de ".$company_name."\n\n";	
				$message.="============================================ \n\n";//Fin coleccion de datos a enviar por correo electronico
				
				mail($email_padre,$Subject,$message);//send email
				  ?>
				  <div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<strong>Bien hecho!</strong> Cuenta activada exitosamente
					
				  </div>
				  <?php
				  }
				  else {
				  ?>
				  <div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
					<strong>Error!</strong> No se ha podido activar la cuenta
					
				  </div>
				  <?php
				  
				  }
				  }
					// show potential errors / feedback (from login object)
					if (isset($login)) {
						if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<strong>Error!</strong> 
						<?php
							foreach ($login->errors as $error) {
								echo $error;
							}
						?>
						</div>
						<?php						
						}
						if ($login->messages) {
							foreach ($login->messages as $message) {
								echo $message;
							}
						}
					}
					?>
              <input type="text" id="login_input_username" name="user_name" class="input-block-level form-control" placeholder="Nombre de usuario" required autofocus >  
              <input type="password" id="login_input_password" name="user_password" autocomplete="off" required class="input-block-level form-control" placeholder="Contrase&ntilde;a" required>
            <div class="control-group">
              <label><a href="reset-password.php">Olvido su contrase&ntilde;a</a> </label>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Iniciar Sesion</button>
          </form>
         </div>
      </div> <!-- End Dashboard -->
   </div> <!--End Col9-->
   <div class="col-md-3"> <!-- Col 3 -->
      <?php 
	  include("sidebar.php");
	  ?>
   </div> <!-- End Col 3 -->
   </section>  <!-- End Main-->
	<?php 
	include ("footer.php");
	?>
    
    <!-- Le javascript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap-transition.js"></script>
    <script src="./assets/js/bootstrap-alert.js"></script>
    <script src="./assets/js/bootstrap-modal.js"></script>
    <script src="./assets/js/bootstrap-dropdown.js"></script>
    <script src="./assets/js/bootstrap-scrollspy.js"></script>
    <script src="./assets/js/bootstrap-tab.js"></script>
    <script src="./assets/js/bootstrap-tooltip.js"></script>
    <script src="./assets/js/bootstrap-popover.js"></script>
    <script src="./assets/js/bootstrap-button.js"></script>
    <script src="./assets/js/bootstrap-collapse.js"></script>
    <script src="./assets/js/bootstrap-carousel.js"></script>
    <script src="./assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>

