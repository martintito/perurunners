<?php 
$base=$business_url_base;
?>
<!DOCTYPE html>
<!--[if IE 8]>     <html class="no-js ie ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9]>     <html class="no-js ie ie9 lte9"> <![endif]-->
<!--[if gt IE 9]>  <html class="no-js"> <![endif]-->
<!--[if !IE]><!--> <html class="no-js"> <!--<![endif]-->
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<?php if (isset($meta_description)){?>
	<meta name="description" content="<?php echo $meta_description;?>">
	<?php }?>
	<?php if(isset($canonical_link)){?>
	<link rel="canonical" href="<?php echo $base.$canonical_link;?>" />
	<?php }?>
    <meta name="viewport" content="width=device-width, initial-scale=0.85">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="author" content="www.perurunners.com">
     <!-- Icons & favicons -->
    <link rel="apple-touch-icon" href="img/apple-icon-touch.png">
    <link rel="icon" href="img/logo_perurunners.png">
    <!--[if IE]>
        <link rel="shortcut icon" href="img/favicon.ico">
    <![endif]-->

    <title><?php if (isset($title)){echo $title." - $business_name";}else{echo "$business_name";}?></title>
	<base href="<?php echo $base;?>"/>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/animate.css/3.5.1/animate.min.css">

    <!-- Custom styles for this template -->
    <link href="css/home.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/themes/theme-15.css" rel="stylesheet" type="text/css" />

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<link href="assets/css/themes/theme-15.css" rel="stylesheet" type="text/css" />
	 <link href="assets/dist/ekko-lightbox.css" rel="stylesheet">
	 <link rel="shortcut icon" href="images/logo_perurunners.png" type="image/png">
  </head>
<body>
    <div class="row datos_empresa_bg top-style">
     <div class="container">
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
          <p class="text-right">
    				<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
    				<?php echo $_SESSION["nombres"],' ', $_SESSION["paterno"],' ',$_SESSION["materno"]; ?> 
            <span class="" aria-hidden="true"></span>&nbsp;-&nbsp;
    				<?php echo $_SESSION["nom_sede"]; ?>&nbsp; | &nbsp;
            <a href="../intranet/ajax/UsuarioAjax.php?op=Salir">Cerrar Sesión</a>
			   </p>
          
         </div>
     </div>
    </div>