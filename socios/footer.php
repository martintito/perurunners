<div class="row-fluid footer">
	<div class="container">
		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<img src="panel/<?php echo $business_logo_url;?>" class="img-responsive">
			<p><?php echo about_info();?>...</p>
			<a href="nosotros">Más sobre nosotros</a>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
			<ul>
				<li><a href="servicio">Servicio al Cliente</a></li>
				<li><a href="politica-de-privacidad">Política de Privacidad</a></li>
				<li><a href="terminos-y-condiciones">Términos y Condiciones</a></li>
			</ul>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			 <h3>Boletín de noticias</h3>
			<form role="form" method="post">
                <div class="input-group">
                    <input type="email" required name="mail" class="form-control" autocomplete="off" placeholder="Ingresa tu correo electrónico">
                    <span class="input-group-btn">
                        <button class="btn btn-info" name="suscribe" type="submit">ir!</button>
                    </span>
                </div>
            </form>	
				<?php
					if (isset($_POST["suscribe"]))
					{
						
						$email=strip_tags($_POST["mail"]);
						if(!filter_var($email, FILTER_VALIDATE_EMAIL))
						  {
						  echo "E-mail no válido";
						  }
						else
						  {
						  $date=date("Y-m-d H:i:s");
						  $boletin="insert into newsletter (email,fecha_registro) values ('$email','$date')";
						  if ($str=mysqli_query($con,$boletin))
						  {
							  echo "Gracias por suscribirse a nuestro boletín de noticias";
						  }
						  else {
							  echo "E-mail ya existe en nuestro boletín de noticias";
						  }
						  }
					}
					?>		
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<h3>Contáctenos</h3>
			<p><i class="fa fa-map-marker "></i> <?php echo $business_address;?></p>
			<p><i class="fa fa-phone"></i> <?php echo $business_phone;?></p>
			<p><i class="fa fa-envelope"></i> <?php echo $business_email;?></p>
		</div>
		
	</div>
	
	
	
</div>
<div class="row-fluid">

	<div class="container text-center">
		<ul class="redes_sociales">
		<?php
			$social_query=mysqli_query($con,"select * from  social_networks");
			while($rw_social=mysqli_fetch_array($social_query)){
				$id=$rw_social['id'];
				$name=$rw_social['name'];
				$url=$rw_social['url'];
				if ($id==1 and !empty($name)){
					echo "<li><a href='$url' target='_blank'><img src='img/icon/face.png' ></a></li>";
				} else if ($id==2 and !empty($name)){
					echo "<li><a href='$url' target='_blank'><img src='img/icon/twitter.png' ></a></li>";
				} else if ($id==3 and !empty($name)){
					echo "<li><a href='$url' target='_blank'><img src='img/icon/google.png' ></a></li>";
				}
			}
		?>
			
			
		</ul>
		<p>© <?php echo date("Y");?> Todos los derechos reservados. <?php echo $_SERVER['SERVER_NAME'];?>  </p>
		
	</div>
</div> 