<?php

/*Datos de la empresa*/
	$sql1=mysqli_query($con,"SELECT * FROM business_profile where id=1");
	$rw1=mysqli_fetch_array($sql1);
	$name=$rw1["name"];
	$industry=$rw1["industry"];
	$number_id=$rw1['number_id'];
	$email=$rw1['email'];
	$phone=$rw1['phone'];
	$tax=$rw1['tax'];
	$currency_id=$rw1['currency_id'];
	$timezone_id=$rw1['timezone_id'];
	$address=$rw1['address'];
	$logo_url=$rw1['logo_url'];
	$url_base=$rw1['url_base'];
	$latitud=$rw1['latitud'];
	$longitud=$rw1['longitud'];
	/*Fin datos empresa*/
	function get_social_net($id){
		global $con;
		$sql=mysqli_query($con,"select * from social_networks where id='$id'");
		$rw=mysqli_fetch_array($sql);
		return $rw['url'];
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
      <?php if ($permisos_ver==1){?>
	   <form class="form" method="post" enctype="multipart/form-data" name="profi" id="profi" >
		  <div class="row">
        
        <div class="col-sm-8">
         
		  
<div class="col-md-12">
			
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-btns">
                <a href="" class="panel-close">×</a>
                <a href="" class="minimize">−</a>
              </div>
              <h4 class="panel-title">Detalles de la empresa</h4>
              </div>
            <div class="panel-body">
			<div id="resultados_ajax"></div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="control-label">Nombre o razón social</label>
                    <input type="text" class="form-control" id="business_name" name="business_name" value="<?php echo $name;?>" required>
                  </div>
                </div>
               
              </div><!-- row -->
              
              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label class="control-label">Giro</label>
                    <input type="text"  class="form-control" name="industry" value="<?php echo $industry;?>" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Registro fiscal</label>
                    <input type="text" name="number_id" class="form-control" value="<?php echo $number_id;?>" required>
                  </div>
                </div>
              </div><!-- row -->
			  
			  <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label class="control-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email;?>" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $phone;?>" required>
                  </div>
                </div>
              </div><!-- row -->
			  
			  <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="control-label">Dirección</label>
                    <textarea name="address" class="form-control" rows=5 required><?php echo $address;?></textarea>
                  </div>
                </div>
                
              </div><!-- row -->
			  
			  <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Latitud</label>
                    <input type="text" class="form-control" name="latitud" id="latitud" value="<?php echo $latitud;?>" >
                  </div>
                </div>
				
				<div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Longitud</label>
                    <input type="text" class="form-control" name="longitud" id="longitud" value="<?php echo $longitud;?>" >
                  </div>
                </div>
                
              </div><!-- row -->
			  
			  <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="control-label">Url del sitio</label>
                    <input type="text" class="form-control" name="url_base" id="url_base" value="<?php echo $url_base;?>" required>
                  </div>
                </div>
                
              </div><!-- row -->
			  
			  <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">IVA %</label>
                    <input type="text" name="tax" class="form-control" value="<?php echo $tax;?>" required maxlength=2>
                  </div>
                </div>
				
				<div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Moneda</label>
                    <?php 
					$query_currencies=mysqli_query($con,"select * from currencies");
					?>
						<select class='form-control ' name="currency" id="currency">
						<?php
							while ($rw_currencies=mysqli_fetch_array($query_currencies)){
								?>
								<option value="<?php echo $rw_currencies['id'];?>" <?php if ($rw_currencies['id']==$currency_id){echo "selected";}else {echo "";}?>><?php echo $rw_currencies['name'];?></option>
								<?php 
							}
						?>
							
						</select>
                  </div>
                </div>
				
				<div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Zona horaria</label>
                   <?php 
					$query_timezones=mysqli_query($con,"select * from timezones order by name");
					?>
						<select class='form-control select2' name="timezone" id="timezone">
						<?php
							while ($rw_timezones=mysqli_fetch_array($query_timezones)){
								?>
								<option value="<?php echo $rw_timezones['id'];?>" <?php if ($timezone_id==$rw_timezones['id']){echo "selected";}else {echo "";}?>><?php echo $rw_timezones['name'];?></option>
								<?php 
							}
						?>
							
						</select>
                  </div>
                </div>
                
              </div><!-- row -->
			  
			  
              
            </div><!-- panel-body -->
            <div class="panel-footer">
              <button type="submit" class="btn btn-primary">Guardar datos</button>
            </div>
          </div>
        </div>
		
     </div><!-- col-sm-8 -->
	 <div class="col-sm-4">
	 <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-btns">
                <a href="" class="panel-close">×</a>
                <a href="" class="minimize">−</a>
              </div>
              <h4 class="panel-title">Logo de la empresa</h4>
              </div>
            <div class="panel-body">
				<div id="load_img" class="col-md-12">
					<img src="<?php echo $logo_url;?>"  class="img-responsive" />
				</div>
             <hr>
			  <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="control-label">Selecciona una imagen</label>
                   <input type="file" name="imagefile" id="imagefile"  class="form-control" onchange="upload_image();">
                  </div>
                </div><!-- col-sm-6 -->
                
              </div><!-- row -->
			 
			  
			  
			  
			  
              
            </div><!-- panel-body -->
            
          </div>
        </div> 
		
		<div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-btns">
                <a href="" class="panel-close">×</a>
                <a href="" class="minimize">−</a>
              </div>
              <h4 class="panel-title">Redes sociales</h4>
              </div>
            <div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
					  <div class="form-group">
						<label class="control-label">Facebook</label>
						<input type="url" class="form-control" id="fb" name="fb" value="<?php echo get_social_net(1);?>" >
					  </div>
					</div>
				</div><!-- row -->
				
				<div class="row">
					<div class="col-sm-12">
					  <div class="form-group">
						<label class="control-label">Twitter</label>
						<input type="url" class="form-control" id="tw" name="tw" value="<?php echo get_social_net(2);?>" >
					  </div>
					</div>
				</div><!-- row -->
				
				<div class="row">
					<div class="col-sm-12">
					  <div class="form-group">
						<label class="control-label">Google plus</label>
						<input type="url" class="form-control" id="gp" name="gp" value="<?php echo get_social_net(3);?>" >
					  </div>
					</div>
				</div><!-- row -->		
              
            </div><!-- panel-body -->
            
          </div>
        </div>
          
        </div><!-- col-sm-4 -->
      </div><!-- row -->
	</form>
     
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
<script src="js/jquery.validate.min.js"></script>

</body>
</html>
	<script>
		function upload_image(){
				
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				if( (typeof file === "object") && (file !== null) )
				{
					$("#load_img").text('Cargando...');	
					var data = new FormData();
					data.append('imagefile',file);
					
					
					$.ajax({
						url: "ajax/imagen_ajax.php",        // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false,       // The content type used when sending data to the server.
						cache: false,             // To unable request pages to be cached
						processData:false,        // To send DOMDocument or non processed data file it is set to false
						success: function(data)   // A function to be called if request succeeds
						{
							$("#load_img").html(data);
							
						}
					});	
				}
				
				
			}
    </script>
	<script>
		// just for the demos, avoids form submit
		jQuery.validator.setDefaults({
		  debug: true,
		  success: "valid"
		});
		var form = $( "#profi" );
		form.validate();
		$("#profi" ).submit(function(event) {
			if (form.valid()==true){
			var parametros = $(this).serialize();
			 $.ajax({
				type: "POST",
				url: "./ajax/editar_perfil.php",
				data: parametros,
				 beforeSend: function(objeto){
					$("#resultados_ajax").html("Mensaje: Cargando...");
				  },
				success: function(datos){
				$("#resultados_ajax").html(datos);
								
			  }
			});
				
				event.preventDefault();
			}
		  
		});
	</script>
