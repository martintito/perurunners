<?php

	session_start();

	require_once "../model/Tipo_Pago.php";

	$objTipo_Pago = new Tipo_Pago();

	switch ($_GET["op"]) {

		case 'SaveOrUpdate':			

			$nombre = $_POST["txtNombre"]; // Llamamos al input txtNombre
			$moneda = $_POST["cboMoneda"];
			$monto = $_POST["txtMonto"];
			if(empty($_POST["txtIdTipo_Pago"])){
				
				if($objTipo_Pago->Registrar($nombre,$moneda,$monto)){
					echo "Tipo de Pago registrado correctamente";
				}else{
					echo "Tipo Pago no ha podido ser registrado.";
				}
			}else{
				
				$idtipo_pago = $_POST["txtIdTipo_Pago"];
				if($objTipo_Pago->Modificar($idtipo_pago,$nombre,$moneda,$monto)){
					echo "La informacion del tipo de Pago ha sido actualizada";
				}else{
					echo "La informacion del tipo de Pago no ha podido ser actualizada.";
				}
			}
			break;

		case "delete":			
			
			$id = $_POST["id"];// Llamamos a la variable id del js que mandamos por $.post (Categoria.js (Linea 62))
			$result = $objTipo_Pago->Eliminar($id);
			if ($result) {
				echo "Eliminado Exitosamente";
			} else {
				echo "No fue Eliminado";
			}
			break;
		
		case "list":
			$query_Tipo = $objTipo_Pago->Listar();

            $i = 1;
     		while ($reg = $query_Tipo->fetch_object()) {
     			$data[] = array(
				    $i,
					//$reg->id_tipo_pago,
                    $reg->descrip_pago,
					//$reg->nom_pago,
                    $reg->moneda,
					$reg->monto,
                    '<button class="btn btn-warning" data-toggle="tooltip" title="Editar" onclick="cargarDataTipo_Pago('.$reg->id_tipo_pago.',\''.$reg->descrip_pago.'\',\''.$reg->moneda.'\','.$reg->monto.')"><i class="fa fa-pencil"></i> </button>&nbsp;'.
                    '<button class="btn btn-danger" data-toggle="tooltip" title="Eliminar" onclick="eliminarTipo_Pago('.$reg->id_tipo_pago.')"><i class="fa fa-trash"></i> </button>'
					);
                $i++;
            }
            echo json_encode($data);

			break;

	}
	