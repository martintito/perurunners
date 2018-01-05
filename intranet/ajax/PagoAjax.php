<?php

	session_start();

	require_once "../model/Pago.php";

	$objPago = new Pagos();

	switch ($_REQUEST["op"]) {

		case 'SaveOrUpdate':			
			$id = $_POST['txtIdSocio'];
			$monto = $_POST['txtMonto'];
			$tipo = $_POST['cboTipo_Pago'];
			$usuario = $_POST['txtIdUsuario'];
			$fecha = $_POST['txtFecha_Pago'];
			$result = $objPago->Registrar($id,$usuario,$tipo,$fecha,$monto);
			if($result){
				echo("Registro Guardado..!");
			}else{
				echo "Error al Grabar el Pago";
			}
			break;
			
		case "delete":			
			
			$id = $_POST["id"];
			$result = $objSocio->Eliminar($id);
			if ($result) {
				echo "Eliminado Exitosamente";
			} else {
				echo "No fue Eliminado";
			}
			break;
		
		case "list":
			$query = $objPago->Listar();
			$data= Array();
            $i = 1;
     		while ($reg = $query->fetch_object()) {

     			$data[] = array("0"=>$i,
					"1"=>$reg->ape_pat.'&nbsp;'.$reg->ape_mat.'&nbsp;'.$reg->nombres,
					"2"=>$reg->nom_sede,
					"3"=>$reg->descrip_pago,
					"4"=>$reg->fecha_pago,
					"5"=>$reg->fecha_regis,
					"6"=>$reg->monto_pago,
					"7"=>$reg->estado_pago
					);
				$i++;
			}
			$results = array(
            "sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
            "aaData"=>$data);
			echo json_encode($results);
			break;
			
		case "listar_Monto_Pago":
			if($_REQUEST["opcion"]){
				$id = $_REQUEST["opcion"];
			}else{
				$id = 1;
			}
			$query = $objPago->listar_Monto_Pago($id);
			$fetch=$query->fetch_object();
			if($fetch){
				json_encode($fetch);
				echo $fetch->monto;
				//echo $fetch->monto.' '.$fetch->moneda;
				//echo " <input id='txtMonto_Pago' type='hidden' name='txtMonto_Pago' value='$fetch->monto'/>";
			}
		    break;
		case "listar_Monto_Pago2":
			if($_REQUEST["opcion"]){
				$id = $_REQUEST["opcion"];
			}else{
				$id = 1;
			}
			$query = $objPago->listar_Monto_Pago($id);
			$data= Array();
     		while ($reg = $query->fetch_object()) {
     			$data[] = array("0"=>$monto,"1"=>$reg->monto.'&nbsp;'.$reg->moneda);
			}
		    break;
		case "listTipo_DocumentoPersona":
		        require_once "../model/Tipo_Documento.php";

		        $objTipo_Documento = new Tipo_Documento();

		        $query_tipo_Documento = $objTipo_Documento->VerTipo_Documento_Persona();

		        while ($reg = $query_tipo_Documento->fetch_object()) {
		            echo '<option value=' . $reg->nombre . '>' . $reg->nombre . '</option>';
		        }

		    break;
			
		case "listar_Tipo_Pagos":
		        require_once "../model/Combos.php";

		        $objCombo = new Combos();

		        $query = $objCombo->listar_Tipo_Pagos();

		        while ($reg = $query->fetch_object()) {
		            echo '<option value=' . $reg->id_tipo_pago . '>' . $reg->descrip_pago . '</option>';
		        }

		    break;
		
	}