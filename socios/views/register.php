<?php
include ("header.php");
?>
  <body>
   <!-- Inicio Header-->
   <header>
      <figure id="logo">
        <a href="index.php"><img src="./assets/images/logo.png" /></a>
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
   <div class="col-md-9"> <!-- Col 9-->
      <div id="dashboard" class="row-fluid"> <!-- Dashboard -->
       <div id="container-ressetp"class="col-md-12">
        <div class="col-md-1">
          <p id="icon-ressetp"class="glyphicon glyphicon-user"></p>
        </div>
        <div class="col-md-9">
          <h1>Iniciar sesión / Crear cuenta nueva</h1>
            <p><strong>Házte miembro, accede a contenido, compra nuestros productos.</strong></p>
        </div>
  <hr>
        <div class="col-md-12">
        	<div id="datos-registro"class="col-md-8">
        		<h3>Ingrese sus datos a continuación</h3>
        		<form  method="post" action="registro.php" name="loginform" id="loginform">
					<?php
					// show potential errors / feedback (from registration object)
					if (isset($registration)) {
						if ($registration->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<strong>Error!</strong> 

						<?php
						foreach ($registration->errors as $error) {
								echo $error;
							}
						?>
						</div>
						<?php						
						}
						if ($registration->messages) {
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<strong>¡Bien hecho!</strong> 
						<?php
							foreach ($registration->messages as $message) {
								echo $message;
							}
						?>
						</div>
						<?php						
						}
					}
					?>
					<?php
						if (isset($_SESSION['parent_id'])){
					$parent_id= $_SESSION['parent_id'];
					}
					else{
					$parent_id=7000;
					}
					?>
        			<div class="form-group">
        				<label>Nombre de usuario</label>
        				<input id="login_input_username" class="form-control" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="Nombre de usuario" required />
						<label for="login_input_username">(sólo letras y nùmeros de 2 a 64 caracteres)</label>
        			</div>
        			<div class="form-group">
        				<label>Correo electrónico</label>
        				<input id="login_input_email" class="form-control" type="email" name="user_email" required placeholder="E-mail" />
        			</div>
					<div class="form-group">
        				<label>Confirma Correo electrónico</label>
        				<input id="login_input_email_confirm" class="form-control" type="email" name="user_email_confirm" required placeholder="E-mail" />
        			</div>
        			<div class="form-group">
        				<label>Contraseña</label>
        				 <input id="login_input_password_new" class="form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Contraseña"/>
						<label for="login_input_password_new">Contraseña (min. 6 caracteres)</label>
					</div>
        			<div class="form-group">
        				<label>Repite la contraseña</label>
        				<input id="login_input_password_repeat" class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Repite la contraseña" />
						<input  class="form-control" type="hidden" name="parent_id" value="<?php echo $parent_id;?>" />
        			</div>
					<div class="form-group">
					<?php
					$rand1=rand(1, 50);
					$rand2=rand(50, 100);
					$hiddenResult=$rand1+$rand2;
					?>
					<label><?php echo $rand1." + ".$rand2." =";?></label>
					<input id="captcha" class="form-control" type="text" name="captcha" pattern="\d*" required autocomplete="off" placeholder="Resultado" maxlength=3 />
					<input id="hiddenResult" class="form-control" type="hidden" value="<?php echo intval($hiddenResult); ?>" />
        			</div>
        			<button type="submit" class="btn btn-success btn-lg btn-block" type="button" name="register">Registrarse</a>
        		</form>
				
        	</div>

        </div>
          
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
	<script>
		$(document).ready(function() {
			$("#loginform").submit(function(){
			var hiddenResult=parseInt($("#hiddenResult").val());
			var user_email=$("#user_email").val();
			var user_email_confirm=$("#user_email_confirm").val();
			var captcha=parseInt($("#captcha").val());
				if (user_email!==user_email_confirm){
				alert("La confirmacion del E-mail es incorrecta.");
				return false;
				}
			  if (hiddenResult!==captcha)
			  {
				alert("Resultado de captcha incorrecto.");
				return false;
			  }
			  
			});
		});
	</script>
  </body>
</html>




