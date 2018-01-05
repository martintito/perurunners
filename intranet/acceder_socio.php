<?php
session_start();
if(isset($_SESSION['idsocio'])){
?>

<?php
/*
if(isset($_SESSION['idsocio'])){
	$mje = $_SESSION['idsocio'];
	echo "<script>alert('Hola Socio')</script>";
	echo $_SESSION['idsocio'];
	echo '<br>',$_SESSION['paterno'];
	echo '<br>',$_SESSION['materno'];
	echo '<br>',$_SESSION['nombres'];
	echo '<br>',$_SESSION["documento"];
	echo '<br>',$_SESSION["numero"];
	echo '<br>',$_SESSION["direccion"];
	echo '<br>',$_SESSION["email"];
	echo '<br>',$_SESSION["fecha_nac"];
	echo '<br>',$_SESSION["genero"];
	echo '<br>',$_SESSION["telef_fijo"];
	echo '<br>',$_SESSION["telef_celu"];
	echo '<br>',$_SESSION["talla_polo"];
	echo '<br>',$_SESSION["talla_zapa"];
	echo '<br>',$_SESSION["id_dist"];
	echo '<br>',$_SESSION["id_sede"];
	echo '<br>',$_SESSION["id_memb"];
}
session_destroy(); */
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PERU RUNNERS | SOCIOS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/css/font-awesome.css">
   
    <!-- Theme style -->
    <link rel="stylesheet" href="public/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="public/css/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
  <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos del Socio</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="frmAcceder" name="frmAcceder">
                  <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                          <div class="box box-widget widget-user-2">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header bg-yellow">
                            <div class="widget-user-image">
                              <img class="img-circle" src="Files/Empleado/ivan.jpg" alt="NOMBRE:">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username"><?php echo $_SESSION["nombres"],' ', $_SESSION["paterno"],' ',$_SESSION["materno"]; ?></h3>
							<div class="widget-user-image">
                            <!--  <img class="img-circle" src="<?php echo $_SESSION["idsocio"]; ?>" alt="SEDE:"> -->
                            </div><!-- /.widget-user-image -->
							<h3><class="widget-user-desc">&nbsp;&nbsp;<?php echo $_SESSION["nom_sede"]; ?></h3>
                          </div>
                          <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                              <li><a href="#"><strong>Documento:</strong>&nbsp; <?php echo $_SESSION["documento"]." ".$_SESSION["numero"]; ?><span class="pull-right badge bg-red"><i class="fa fa-fw fa-book"></i></span></a></li>
                              <li><a href="#"><strong>Telefono:</strong>&nbsp; <?php echo $_SESSION["telef_fijo"]?> <span class="pull-right badge bg-blue"><i class="fa fa-fw fa-mobile-phone"></i></span></a></li>
                              <li><a href="#"><strong>Direccion:</strong>&nbsp; <?php echo $_SESSION["direccion"]?> <span class="pull-right badge bg-aqua"><i class="fa fa-fw fa-taxi"></i></span></a></li>
                            </ul>
                          </div>
                        </div><!-- /.widget-user -->

                    </div>
                  </div> 
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <a type="button" href="ajax/UsuarioAjax.php?op=Salir" class="btn btn-danger">Cerrar Sesión</a>
                  </div>
                </form>
              </div><!-- /.box -->
              
            </div><!--/.col (left) -->
    
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

	  
	   <div class="row">
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h1 class="box-title">PORTAL WEB EN DESARROLLO..! ESTAMOS TRABAJANDO PARA USTED...!</h1>
                </div><!-- /.box-header -->
     
              </div><!-- /.box -->
              
            </div><!--/.col (left) -->
    
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  
    <!-- jQuery 2.1.4 -->
    <script src="public/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="public/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="public/js/icheck.min.js"></script>
    
    <script type="text/javascript">
      $(document).on("ready", init);

      function init(){

        ListadoIngresos();

        function ListadoIngresos(){ 
          $.post("ajax/SucursalAjax.php?op=listSucursalEmp", function(r){
                $("#Sucursal").html(r);
          });
        };


      }

      function Acceder(idusuario, idsucursal, idempleado, empleado, tipo_documento, tipo_usuario, num_documento, direccion, telefono, foto, logo, email, login, razon_social, mnu_almacen, mnu_compras, mnu_ventas, mnu_mantenimiento, mnu_seguridad, mnu_consulta_compras, mnu_consulta_ventas, mnu_admin){
        var data = { 
            idusuario : idusuario,
            idsucursal : idsucursal,
            idempleado : idempleado,
            empleado : empleado,
            tipo_documento : tipo_documento,
            tipo_usuario : tipo_usuario,
            num_documento : num_documento,
            direccion : direccion,
            telefono : telefono,
            foto : foto,
            logo : logo,
            email : email,
            login : login,
            razon_social : razon_social,
            mnu_almacen : mnu_almacen,
            mnu_compras : mnu_compras,
            mnu_ventas : mnu_ventas,
            mnu_mantenimiento : mnu_mantenimiento,
            mnu_seguridad : mnu_seguridad,
            mnu_consulta_compras : mnu_consulta_compras,
            mnu_consulta_ventas : mnu_consulta_ventas,
            mnu_admin : mnu_admin
        };
        $.post("ajax/UsuarioAjax.php?op=IngresarPanel", data, function(r){
                $(location).attr("href", "Escritorio.php");
          });
      }

      function AccederSuperAdmin(idempleado, idusuario, idsucursal, estadoAdmin, empleado, tipo_documento, direccion, telefono, foto, email, login, mnu_almacen, mnu_compras, mnu_ventas, mnu_mantenimiento, mnu_seguridad, mnu_consulta_compras, mnu_consulta_ventas, mnu_admin, logo){
        var data = { 
            idempleado : idempleado,
            idusuario : idusuario,
            idsucursal : idsucursal,
            estadoAdmin : estadoAdmin,
            empleado : empleado,
            tipo_documento : tipo_documento,
            direccion: direccion,
            telefono : telefono,
            foto : foto,
            email : email,
            login : login,
            mnu_almacen : mnu_almacen,
            mnu_compras : mnu_compras,
            mnu_ventas : mnu_ventas,
            mnu_mantenimiento : mnu_mantenimiento,
            mnu_seguridad : mnu_seguridad,
            mnu_consulta_compras : mnu_consulta_compras,
            mnu_consulta_ventas : mnu_consulta_ventas,
            mnu_admin : mnu_admin,
            logo: logo
        };
        $.post("ajax/UsuarioAjax.php?op=IngresarPanelSuperAdmin", data, function(r){
                $(location).attr("href", "Escritorio.php");
          });
      }

    </script>
  </body>
</html>
<?php

 /* } else if(isset($_SESSION['idsocio'])) {
    header("Location:socio.php"); */
  } else{
	  header("Location:index.html");
  }
  
?>