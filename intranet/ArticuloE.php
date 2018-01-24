<?php
require_once "./model/Articulo.php";
	session_start();

	if(isset($_SESSION["idusuario"]) && $_SESSION["mnu_almacen"] == 1){
            
////            print_r(is_int($_GET['id']));exit;
//            if (is_int($_GET['id'])) {
//                echo "La variable es entera";exit;
//            }else{
//                echo "La variable no es entera";exit;
//            }

	if(!(ctype_digit($_GET['id'])) || empty($_GET['id']) || $_GET['id'] == null){
             header("Location:Articulo.php");
            
        } else {
           $objArticulo = new Articulo();                
                $query_Articulo = $objArticulo->Detalle($_GET['id']);
                $arrayArticulo = array();
                $j = 0;
                while ($reg = $query_Articulo->fetch_object()) {
                    $arrayArticulo['idcategoria'] = $reg->idcategoria;                              
                    $arrayArticulo['nombre'] = $reg->nombre;
                    $arrayArticulo['descripcion'] = $reg->descripcion;
                    $arrayArticulo['unidad_medida'] = $reg->unidad_medida;
//                    print_r($reg);
                    $j++;
                }
                
                
                require_once "./model/Categoria.php";
                $objCategoria = new Categoria();

                $query_Categoria = $objCategoria->Listar();
                $arrayCategoria = array();
                $i = 0;
                while ($regcat = $query_Categoria->fetch_object()) {
                    $arrayCategoria[$i]['idcategoria'] = $regcat->idcategoria;                              
                    $arrayCategoria[$i]['nombre'] = $regcat->nombre;
                    $i++;
                } 
                
//                print_r($arrayCategoria);

                $query_Unidad = $objCategoria->ListarUM();
                $arrayUnidad = array();
                $i = 0;
                while ($regUni = $query_Unidad->fetch_object()) {
                    $arrayUnidad[$i]['idunidad_medida'] = $regUni->idunidad_medida;                              
                    $arrayUnidad[$i]['nombre'] = $regUni->nombre;
                    $i++;
                }
                
//                print_r($arrayCategoria);
                
                if ($_SESSION["superadmin"] != "S") {
			include "view/header.html";
//                        print_r($_GET);
			include "view/ArticuloE.php";
		} else {
			include "view/headeradmin.html";
			include "view/ArticuloE.php";
		}
        }
            
                

		include "view/footer.html";
	} else {
		header("Location:index.html");
	}
		

