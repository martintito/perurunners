<?php
include("config/conexion.php");
include("slug.php");//Slug URL amigables
//Recibe variebles GET
$id_fabricante=$_GET['id_fabricante'];
$lbl_marca=$_GET['nombre_marca'];
//Fin de obtencion de varariables GET
$sql_marca=mysqli_query($con,"select * from fabricantes where id_fabricante='".$id_fabricante."'");
$rw_marca=mysqli_fetch_array($sql_marca);
$nombre_fabricante=$rw_marca['nombre_fabricante'];

$title=$nombre_fabricante;
$canonical_link="marca/$id_fabricante/$lbl_marca";
$meta_description="$business_name es una tienda especializada en la venta de: Escáneres de códigos de barras, impresoras de etiquetas, impresoras de recibos, Punto de Venta, pantallas táctiles, venta de software de inventario y facturación";
include ("header.php");
include ("logo.php");
include("sidebar.php");
include("productos-marcas.php"); 
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