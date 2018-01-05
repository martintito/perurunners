<?php
include("config/conexion.php");
include("slug.php");//Slug URL amigable
include("./control/functions.php");//Slug URL amigables
//Recibe variebles GET
$categoria=$_GET['categoria'];
$lbl_producto=$_GET['producto'];
//Fin de obtencion de varariables GET
$sql_categoria=mysqli_query($con,"select * from categorias where id_categoria='".$categoria."'");
$rw_categoria=mysqli_fetch_array($sql_categoria);
$categoria_padre=$rw_categoria['parent'];
if ($categoria_padre==0){
	$categoria_principal=$rw_categoria['nombre_categoria'];
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
	$categoria_level=$rw_categoria['nombre_categoria'];
	$sql2_categoria=mysqli_query($con,"select * from categorias where id_categoria='".$categoria_padre."'");
	$rw2_categoria=mysqli_fetch_array($sql2_categoria);
	$categoria_principal=$rw2_categoria['nombre_categoria'];
	$id_categoria_padre= $rw2_categoria['id_categoria'];
	$str_categoria="productos.id_categoria='$categoria'";
	
}
$title=$categoria_principal;
$canonical_link="categoria/$categoria/$lbl_producto";
$meta_description="$business_name es una tienda especializada en la venta de: Escáneres de códigos de barras, impresoras de etiquetas, impresoras de recibos, Punto de Venta, pantallas táctiles, venta de software de inventario y facturación";
include ("header.php");
include ("logo.php");
include("sidebar.php");
include("productos-categoria.php"); 
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
</body>
</html>