<?php
		if (empty($_POST['business_name'])){
			$errors[] = "Nombre del negocio está vacío";
		}else if (empty($_POST['number_id'])){
			$errors[] = "Número de registro está vacío";
		} else if (empty($_POST['email'])){
			$errors[] = "Email está vacío";
		} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } else if (empty($_POST['phone'])){
			$errors[] = "Teléfono está vacío";
		} else if (empty($_POST['address'])){
			$errors[] = "La dirección está vacía";
		}  elseif (
			!empty($_POST['address'])
			&& !empty($_POST['business_name'])
			&& !empty($_POST['number_id'])
			&& filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
			) {
		
			
			require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			function update_social_net($id,$url){
				global $con;
				$sql=mysqli_query($con,"update social_networks set url='$url' where id='$id'");
				return $sql;
			}
	
			
			// escaping, additionally removing everything that could be (html/javascript-) code
                $business_name = mysqli_real_escape_string($con,(strip_tags($_POST["business_name"],ENT_QUOTES)));
				$industry = mysqli_real_escape_string($con,(strip_tags($_POST["industry"],ENT_QUOTES)));
				$number_id = mysqli_real_escape_string($con,(strip_tags($_POST["number_id"],ENT_QUOTES)));
				$email= mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
				$phone= mysqli_real_escape_string($con,(strip_tags($_POST["phone"],ENT_QUOTES)));
				$tax= intval($_POST["tax"]);
				$currency= intval($_POST["currency"]);
				$timezone=intval($_POST["timezone"]);
				$address = mysqli_real_escape_string($con,(strip_tags($_POST["address"],ENT_QUOTES)));
				$url_base = mysqli_real_escape_string($con,(strip_tags($_POST["url_base"],ENT_QUOTES)));
				$latitud = mysqli_real_escape_string($con,(strip_tags($_POST["latitud"],ENT_QUOTES)));
				$longitud = mysqli_real_escape_string($con,(strip_tags($_POST["longitud"],ENT_QUOTES)));
				$fb=mysqli_real_escape_string($con,(strip_tags($_POST["fb"],ENT_QUOTES)));
				update_social_net(1,$fb);//Actualiza url
				$tw=mysqli_real_escape_string($con,(strip_tags($_POST["tw"],ENT_QUOTES)));
				update_social_net(2,$tw);//Actualiza url
				$gp=mysqli_real_escape_string($con,(strip_tags($_POST["gp"],ENT_QUOTES)));
                update_social_net(3,$gp);//Actualiza url
            
				// update data
                    $sql = "UPDATE business_profile SET name='".$business_name."', industry='".$industry."', number_id='".$number_id."', email='".$email."', phone='".$phone."', address='".$address."', tax='".$tax."', currency_id='".$currency."', timezone_id='".$timezone."', url_base='".$url_base."', latitud='".$latitud."', longitud='".$longitud."' WHERE id='1' ";
                    $query = mysqli_query($con,$sql);

                    // if user has been update successfully
                    if ($query) {
                        $messages[] = "Los datos han sido actualizados exitosamente.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
                
			
		} else {
			$errors[] = " Desconocido";	
		}
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>			