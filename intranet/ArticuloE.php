<?php
require_once "./model/Articulo.php";
	session_start();

	if(isset($_SESSION["idusuario"]) && $_SESSION["mnu_almacen"] == 1){

		if ($_SESSION["superadmin"] != "S") {
			include "view/header.html";
                        print_r($_GET);
			include "view/ArticuloE.php";
		} else {
			include "view/headeradmin.html";
			include "view/ArticuloE.php";
		}
                $objArticulo = new Articulo();                
                $query_Articulo = $objArticulo->Detalle($_GET['id']);
                while ($reg = $query_Articulo->fetch_object()) {
                    echo $reg->idarticulo . '-' . $reg->idcategoria;
                }

		include "view/footer.html";
	} else {
		header("Location:index.html");
	}
		

