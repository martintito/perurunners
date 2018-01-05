<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Panel de Administracion</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Le styles -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/bootstrap-theme.css" rel="stylesheet">
    <link href="./assets/css/login.css" rel="stylesheet">
    <link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <!-- JS -- >
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="./assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
  <link rel="shortcut icon" href="../assets/ico/favicon.ico">
  </head>
  <body>
   <!-- Inicio Header-->
   <header>
      <figure id="logo">
        <a href="index.html"><img src="./assets/images/logo.png" /></a>
      </figure> 
      <nav id="menuTop" class="navbar-collapse">
      <ul id="menu-ul" class="nav navbar-nav">
         <li>
            <a href="index.html">Inicio</a>
         </li>
          <li>
            <a href="#">Nosotros</a>
         </li>
          <li>
            <a href="#">FAQs</a>
         </li>
          <li>
            <a href="#">Foros</a>
         </li>
         <li> 
            <a href="#">Contactenos</a>
         </li>
      </ul>
   </nav>
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
          <h1>Restablecer contrase&ntilde;a</h1>
            
        </div>
  <hr>
        <div class="col-md-12">
        	<div id="datos-registro"class="col-md-8">
        		
        		<form  method="post" action="reset.php" name="loginform">
					 <?php
					if (isset($errors))
					{
					?>
					
						<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<strong>Error!</strong>
					<?php
							foreach ($errors as $error)
							{
								echo $error;
							}
							?>
							</div>
						<?php
							}
							if (isset($messages))
							{
							?>
							<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<strong>¡Bien hecho!</strong>
							<?php
								foreach ($messages as $message)
									{
										echo $message;
									}
							?>
							</div>
								<?php
							}
						?>		
        			
        			
        			<div class="form-group">
        				<label>Contrase&ntilde;a nueva</label>
        				 <input id="login_input_password_new" class="form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="Contrase&ntilde;a"/>
						<label for="login_input_password_new">Contrase&ntilde;a (min. 6 caracteres)</label>
					</div>
        			<div class="form-group">
        				<label>Repite la contrase&ntilde;a</label>
        				<input id="login_input_password_repeat" class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Confirma la contrase&&ntilde;a" />
						<input  class="form-control" type="hidden" name="user_id"  value="<? echo $user_id;?>"/>
        			</div>
        			
        			<button type="submit" class="btn btn-success btn-lg btn-block" type="button" name="newpass">Restablecer</a>
        		</form>
        	</div>
        	
        </div>
          
        </div>
      </div> <!-- End Dashboard -->
   </div> <!--End Col9-->
   <div class="col-md-3"> <!-- Col 3 -->
      <div id="sidebar">
         <div id="title-sidebar">
            <h2>Miembros <strong>Global</strong>icom</h2>
         </div>
         <ul class="nav nav-pills nav-stacked">
            <li>
               <a class="glyphicon glyphicon-home" href="index.php"> Inicio</a>
            </li>
            <li>
               <a class="glyphicon glyphicon-shopping-cart" href="index.html"> Ordenar</a>
            </li>
            <li>
               <a class="glyphicon glyphicon-edit" href="#"> Blog</a>
            </li>
            <li>
               <a class="glyphicon glyphicon-comment" href="#"> FAQs</a>
            </li>
            <li>
               <a class="glyphicon glyphicon-thumbs-up" href="#"> Foro</a>
            </li>
            <li>
               <a class="glyphicon glyphicon-envelope" href="#"> Contactenos</a>
            </li>
         </ul>
      </div> <!-- End Sidebar-->
   </div> <!-- End Col 3 -->
   </section>  <!-- End Main-->
   <footer class="container-12"> 
      <div id="colums-footer" class="container">
         <div id="col-1" class="col-md-3"> 
            <h3>Enlaces de Interes</h3>
            <div id="links-col">
               <a href="#">Política de Reembolso</a>
              <a href="#">Términos y Condiciones</a>
              <a href="#">Políticas de Privacidad</a>
              <a href="#">Aviso Legal</a>
           </div>
         </div>
         <div id="col-2" class="col-md-3"> 
             <h3>Datos Contacto</h3>
             <div id="contact-data"> 
               <p class="glyphicon glyphicon-phone-alt"> (703)000-0000</p>
               <p class="glyphicon glyphicon-envelope"> soporte@globalicom.com</p>
               <p class="glyphicon glyphicon-shopping-cart"> 1325 W. Silverlake Rd SPC 120 Los Angeles, California 85713</p>
             </div>
         </div>
         <div id="col-3" class="col-md-3"> 
            <h3>Siguenos</h3>
         <div id="redes-sociales">
            <a href="http://facebook.com" target="_blank"><img src="./assets/images/facebook.png" /></a>
            <a href="http://twitter.com" target="_blank"><img src="./assets/images/twitter.png" /> </a>
            <a href="http://skype.com" target="_blank"><img src="./assets/images/skype.png" /></a>
             <a href="http://youtube.com" target="_blank"><img src="./assets/images/youtube.png" /></a>
          </div>
             
         </div>
         <div id="col-4" class="col-md-3"> 
             <h3>Pagos Seguros</h3>
             <img src="./assets/images/logo.png" />
             <figure>
                  <img src="./assets/images/seguro.png" />
                  <img src="./assets/images/visa.png" />
                  <img src="./assets/images/mastercard.png" />
                  <img src="./assets/images/americanexpress.png" />
             </figure>
         </div>
      </div>
      <div id="copyrigth" class="container-12">
         <p>Globalicom 100% / ACCELERATED MARKETING TECHNOLOGIES LLC, © TODOS LOS DERECHOS RESERVADOS</p>
         <p class="h5"> Términos y Condiciones | Políticas de Privacidad | Políticas de Pago | Política de Reembolso | Aviso Legal |  Area de Miembros</p>
      </div>

   </footer>
   
    
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