<?php
session_start();
include("config/conexion.php");
include("slug.php");//Slug URL amigables
//Recibe variebles GET
$id_producto=$_GET['id_producto'];
//Fin de obtencion de varariables GET
$sql_producto=mysqli_query($con,"select * from productos, categorias where productos.id_categoria=categorias.id_categoria and productos.id_producto='".$id_producto."' and productos.status_producto!=0");
$rw_producto=mysqli_fetch_array($sql_producto);
$num_row=mysqli_num_rows($sql_producto);
if ($num_row!=1){
	header ("location: ../../");
	exit;
}
$categoria_padre=$rw_producto['parent'];
$categoria=$rw_producto['id_categoria'];
$nombre_producto=$rw_producto['nombre_producto'];
$id_fabricante=$rw_producto['id_fabricante'];
$modelo_producto=$rw_producto['modelo_producto'];
$imagen_producto=$rw_producto['img'];
$descripcion=$rw_producto['descripcion_producto'];
$show_price=$rw_producto['show_price'];
$price=$rw_producto['price'];
$status_producto=$rw_producto['status_producto'];
if ($categoria_padre==0){
	$categoria_principal=$rw_producto['nombre_categoria'];
	$id_categoria_padre=$categoria;
	$sql_cat=mysqli_query($con,"select * from categorias where parent='$categoria'");
	$count_cat=mysqli_num_rows($sql_cat);
	if ($count_cat==0){
		$str_categoria="productos.id_categoria='$categoria'";
	} else{
	$str_categoria="categorias.parent='$categoria'";	
	}
		
}
else {
	$categoria_level=$rw_producto['nombre_categoria'];
	$sql2_categoria=mysqli_query($con,"select * from categorias where id_categoria='".$categoria_padre."'");
	$rw2_categoria=mysqli_fetch_array($sql2_categoria);
	$categoria_principal=$rw2_categoria['nombre_categoria'];
	$id_categoria_padre= $rw2_categoria['id_categoria'];
	$str_categoria="productos.id_categoria='$categoria'";
	
}
$title=$nombre_producto;
$lbl_producto=create_slug($nombre_producto);
$meta_description="Producto: $nombre_producto";
$canonical_link="producto/$id_producto/$lbl_producto";
include ("header.php");
//include ("logo.php");
include("slider.php");
include("sidebar.php");
include("item.php"); 
include("marcas.php"); 
include("principales.php");
include("footer.php");

?>

    <!-- Le javascript -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/init.js"></script>
	<script src="js/consulta_precio.js"></script>
	<script src="js/ekko-lightbox.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function ($) {
                // delegate calls to data-toggle="lightbox"
                $(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
                    event.preventDefault();
                    return $(this).ekkoLightbox({
                        onShown: function() {
                            if (window.console) {
                                return console.log('Checking our the events huh?');
                            }
                        },
						onNavigate: function(direction, itemIndex) {
                            if (window.console) {
                                return console.log('Navigating '+direction+'. Current item: '+itemIndex);
                            }
						}
                    });
                });

                //Programatically call
                $('#open-image').click(function (e) {
                    e.preventDefault();
                    $(this).ekkoLightbox();
                });
                $('#open-youtube').click(function (e) {
                    e.preventDefault();
                    $(this).ekkoLightbox();
                });

				// navigateTo
                $(document).delegate('*[data-gallery="navigateTo"]', 'click', function(event) {
                    event.preventDefault();

                    var lb;
                    return $(this).ekkoLightbox({
                        onShown: function() {

                            lb = this;

							$(lb.modal_content).on('click', '.modal-footer a', function(e) {

								e.preventDefault();
								lb.navigateTo(2);

							});

                        }
                    });
                });


            });
        </script>
</body>
</html>
