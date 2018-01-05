<?php

	session_start();

	require_once "../model/Socio.php";

	$objSocio = new Socio();

	switch ($_REQUEST["op"]) {

		case 'SaveOrUpdate':			
			$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
			$repl = array('a', 'e', 'i', 'o', 'u', 'n');
			$pat = $_POST['paterno'];
			$pat = strtolower($pat);
			$pat = str_replace ($find, $repl, $pat);
			$mat = $_POST['materno'];
			$mat = strtolower($mat);
			$mat = str_replace ($find, $repl, $mat);
			$nom = $_POST['nombre'];
			$nom = strtolower($nom);
			$nom = str_replace ($find, $repl, $nom);
			$dir = $_POST['direccion'];
			$dis = $_POST['distrito'];
			if(!isset($_POST['sede'])){
				$sede = 1;
			}else{
				$sede = $_POST['sede'];
			}
			//$sede = $_POST['sede'];
			$doc = $_POST['tipo_doc'];
			$num = $_POST['num_doc'];
			$fec = $_POST['fecha_nac'];
			$mail = $_POST['email'];
			$tel = $_POST['tele_fijo'];
			$cel = $_POST['celular'];
			$gen = $_POST['sexo'];
			$talp = $_POST['talla_pol'];
			$talz = $_POST['talla_zap'];
			
			//$mem = $_POST['membresia'];
			if(!isset($_POST['membresia'])){
				$mem = 1;
			}else{
				$mem = $_POST['membresia'];
			}
			//$foto = $_POST['foto'];
			//$foto = $_FILES["foto"]["name"];
			$pais = $_POST['pais'];
			$civil = $_POST['estado_civil'];
			//$disca = '';
			$disca = $_POST['discapa'];
			/* if(isset($_POST['radio1'])){
				$disca = 'Ninguno';
			} */
			$club = $_POST['nombre_club'];
			/* if(isset($_POST['club1'])){
				$club = 'Ninguno';
			} */
			$corre = $_POST['corres'];
			
			$conta = $_POST['nombre_contacto'];
			$telcon = $_POST['telefono_contacto'];
			
			$numtar = $_POST['numero_tarjeta'];
			$tiptar = $_POST['tipo_tarjeta'];
			//$banco = $_POST['banco'];
			if(!isset($_POST['banco'])){
				$banco = 1;
			}else{
				$banco = $_POST['banco'];
			}
			if($_FILES["fotografia"]["tmp_name"]!=null){
				$imagen = $_FILES["fotografia"]["tmp_name"];
				$exten = end(explode(".", $_FILES['fotografia']['name']));
				$exten = $num.'.'.$exten;
				move_uploaded_file($imagen, "../Files/Socios/".$exten);
				$imagen = "Files/Socios/".$exten;
			}else{
				$imagen = $_POST['foto_socio'];
			}
			$login = $_POST['nuevo_usuario'];
			$clave = $_POST['clave_nueva'];
			$est = $_POST['estado'];
			if(isset($_REQUEST['idsocio'])){
				$id = $_REQUEST['idsocio'];
				/*
				$result = $objSocio->Modificar($id,$pat,$mat,$nom,$doc,$num,$dir,$mail,$tel,$cel,$civil,$fec,$talp,$talz,$imagen,$conta,$telcon,$tiptar,$numtar,$login,$clave,$pais,$dis,$sede,$banco);
				*/
				$result = $objSocio->Modificar($id,$dir,$mail,$tel,$cel,$civil,$talp,$talz,$imagen,$conta,
					$telcon,$tiptar,$numtar,$login,$clave,$dis,$sede,$banco);
				
				if($result){
					echo "La información del Socio ha sido actualizada";
				}else{
					echo "La información del Socio no ha sido registrado";
				}
			}else{
				$result = $objSocio->Registrar($pat,$mat,$nom,$doc,$num,$dir,$mail,$tel,$cel,$civil,$fec,$gen,$talp,$talz,
				$corre,$imagen,$disca,$club,$conta,$telcon,$tiptar,$numtar,$est,$pais,$dis,$sede,$mem,$banco);
				if($result){
					//echo "Gracias lobo por registrarse su nombre de usuario es: ".$num." y su clave es: ".$num;
					echo("Gracias ".$nom." por registrarse \nSu nombre de usuario es: ".$num."\nSu clave secreta es: ".$num);
					//include '../correo.php';
				}else{
					echo "La información del Socio no ha sido registrado";
				}
			}
			break;
			
		case 'SaveOrUpdate2':			
			$id = $_POST["txtIdSocio"];
			$pat = $_POST["txtApe_pat"];
			$mat = $_POST["txtApe_mat"];
			$nom = $_POST["txtNombres"];
			$doc = $_POST["cboTipo_Documento"];
			$num = $_POST["txtNum_Documento"];
			$dir = $_POST["txtDireccion"];
			$mail = $_POST["txtEmail"];
			$fec = $_POST["txtFecha_Nacimiento"];
			$tel = $_POST["txtTelefono"];
			$talp = $_POST["txtPolo"];
			$talz = $_POST["txtZapatilla"];
			$login = $_POST["txtLogin"];
			$clave = $_POST["txtClave"];
			$est = $_POST["txtEstado"];
			$dis = $_POST["cboTipo_Distritos"];
			$sede = $_POST["cboTipo_Sedes"];
			$mem = $_POST["cboTipo_Membresias"];
			
			$banco = $_POST["cboBanco"];
			$pais = $_POST["cboPaises"];
			
			$civil = $_POST["txtEstado_civil"];
			$cel = $_POST["txtCelular"];
			$gen = $_POST["txtGenero"];
			$corre = $_POST["txtCorre"];
			$disca = $_POST["txtDiscapacidad"];
			$club = $_POST["txtClub"];
			
			$conta = $_POST["txtNombre_contacto"];
			$telcon = $_POST["txtTelefono_contacto"];
			$tiptar = $_POST["txtTipo_tarjeta"];
			$numtar = $_POST["txtNro_tarjeta"];
				
				if(!empty($_POST["txtIdSocio"])){
					if($objSocio->Modificar2($id,$pat,$mat,$nom,$doc,$num,$dir,$mail,$tel,$cel,$civil,$fec,$gen,$talp,$talz,
							$corre,$disca,$club,$conta,$telcon,$tiptar,$numtar,$login,$clave,$pais,$dis,$sede,$mem,$banco)){
							echo "La información del Socio ha sido actualizada.";
					}else{
							echo "La información del Socio no ha podido ser actualizada.";
					}
					
				}else{
					if($objSocio->Registrar($id,$pat,$mat,$nom,$doc,$num,$dir,$mail,$fec,$gen,$tel,$cel,$talp,$talz,$log,$cla,$est,$dis,$sede,$mem)){
						echo "Socio Registrado correctamente.";
					}else{
						echo "Socio no ha podido ser registado.";
					}					
				}
			break;
			
		case 'SaveOrUpdate3':			
			$id = $_POST["idsocio"];
			$tiptar = $_POST["tipo_tarjeta"];
			$numtar = $_POST["numero_tarjeta"];
			$banco = $_POST['banco'];
			$sede = $_POST["sede"];
			$mem = $_POST["membresias"];
			$estado = $_POST["estado"];
			
				if(!empty($_POST["idsocio"])){
					if($objSocio->Modificar3($tiptar,$numtar,$sede,$mem,$banco,$estado,$id)){
							echo "La información del Socio ha sido actualizada.";
					}else{
							echo "La información del Socio no ha podido ser actualizada.";
					}
					
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
			$query_Tipo = $objSocio->Listar();
			$data= Array();
            $i = 1;
     		while ($reg = $query_Tipo->fetch_object()) {

     			$data[] = array("0"=>$i,
					"1"=>$reg->ape_pat.'&nbsp;'.$reg->ape_mat.'&nbsp;'.$reg->nombres,
					//"2"=>$reg->tipo_doc,
					"2"=>$reg->num_doc,
					"3"=>$reg->direccion,
					"4"=>$reg->email,
					"5"=>$reg->fecha_reg,
					//"6"=>$reg->fecha_nac,
					"6"=>$reg->telef_fijo,
					"7"=>$reg->telef_celu,
					"8"=>$reg->nom_sede,
					"9"=>$reg->talla_polo,
					"10"=>$reg->talla_zapa,
					"11"=>$reg->nom_pais,
					"12"=>"<img width=100px height=100px src='$reg->foto_socio'/>",
					//"7"=>'<img width=100px height=100px src="./'.$reg->idsocio.'" />'
					"13"=>'<button class="btn btn-warning" data-toggle="tooltip" title="Editar" onclick="cargarDataSocio('.$reg->idsocio.',\''.$reg->ape_pat.'\',\''.$reg->ape_mat.'\',\''.$reg->nombres.'\',\''.$reg->tipo_doc.'\',\''.$reg->num_doc.'\',\''.$reg->direccion.'\',\''.$reg->telef_fijo.'\',\''.$reg->telef_celu.'\',\''.$reg->est_civil.'\',\''.$reg->email.'\',\''.$reg->fecha_nac.'\',\''.$reg->genero.'\',\''.$reg->talla_polo.'\',\''.$reg->talla_zapa.'\',\''.$reg->correrxsem.'\',\''.$reg->discapacidad.'\',\''.$reg->miembro_club.'\',\''.$reg->nom_contacto.'\',\''.$reg->telef_contacto.'\',\''.$reg->tipo_tarjeta.'\',\''.$reg->num_tarjeta.'\',\''.$reg->id_pais.'\',\''.$reg->id_sede.'\',\''.$reg->id_dist.'\',\''.$reg->id_memb.'\',\''.$reg->id_banco.'\',\''.$reg->login.'\',\''.$reg->clave.'\',\''.$reg->estado.'\')">'.
					'<i class="fa fa-pencil"></i> </button>&nbsp;'.
					'<button class="btn btn-danger" data-toggle="tooltip" title="Eliminar" onclick="eliminarSocio('.$reg->idsocio.')"><i class="fa fa-trash"></i> </button>'
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

		case "listTipo_DocumentoPersona":
		        require_once "../model/Tipo_Documento.php";

		        $objTipo_Documento = new Tipo_Documento();

		        $query_tipo_Documento = $objTipo_Documento->VerTipo_Documento_Persona();

		        while ($reg = $query_tipo_Documento->fetch_object()) {
		            echo '<option value=' . $reg->nombre . '>' . $reg->nombre . '</option>';
		        }

		    break;
			
		case "listar_Distritos":
		        require_once "../model/Combos.php";

		        $objCombo = new Combos();

		        $query = $objCombo->listar_Distritos();

		        while ($reg = $query->fetch_object()) {
		            echo '<option value=' . $reg->id_distrito . '>' . ucwords(strtolower($reg->nom_distrito)). '</option>';
		        }

		    break;
		case "listar_Sedes":
		        require_once "../model/Combos.php";

		        $objCombo = new Combos();

		        $query = $objCombo->listar_Sedes();

		        while ($reg = $query->fetch_object()) {
		            echo '<option value=' . $reg->id_sede . '>' . $reg->nom_sede . '</option>';
		        }

		    break;
		case "listar_Membresias":
		        require_once "../model/Combos.php";

		        $objCombo = new Combos();

		        $query = $objCombo->listar_Membresias();

		        while ($reg = $query->fetch_object()) {
		            echo '<option value=' . $reg->id_memb . '>' . $reg->des_memb. '</option>';
		        }

		    break;
		case "listarSocio":

			$query = $objSocio->listarSocio();
			$i = 1;
            while ($reg = $query->fetch_object()) {
                 echo '<tr><td><input type="radio" name="optSocioBusqueda" data-nombre="'.$reg->ape_pat.'&nbsp;'.$reg->ape_mat.'&nbsp;'.$reg->nombres.'" data-email="'.$reg->email.'" id="'.$reg->idsocio.'" value="'.$reg->idsocio.'" /></td>
                        <td>'.$i.'</td><td>'.$reg->ape_pat.'&nbsp;'.$reg->ape_mat.'&nbsp;'.$reg->nombres.'</td>
                        <td>'.$reg->nom_sede.'</td>
                        <td>'.$reg->fecha_reg.'</td>
                        <td>'.$reg->email.'</td>
                       </tr>';
                 $i++; 
            }

			break;
		case "listar_Paises":
		        require_once "../model/Combos.php";

		        $objCombo = new Combos();

		        $query = $objCombo->listar_Paises();

		        while ($reg = $query->fetch_object()) {
		            echo '<option value=' . $reg->id_pais . '>' . $reg->nom_pais . '</option>';
		        }

		    break;
		case "listar_Bancos":
		        require_once "../model/Combos.php";

		        $objCombo = new Combos();

		        $query = $objCombo->listar_Bancos();

		        while ($reg = $query->fetch_object()) {
		            echo '<option value=' . $reg->id_banco . '>' . $reg->nom_banco . '</option>';
		        }

		    break;
		case "ListMem1":
				$id = $_POST["opcion"];
		        $query = $objSocio->ListMem1($id);
				
				$fetch=$query->fetch_object();
				if($fetch){
					json_encode($fetch);
					echo $fetch->precio_memb;
				}
		    break;
		case "listar_Membresias2":
			 require_once "../model/Combos.php";

		        $objCombo = new Combos();

		        $query = $objCombo->listar_Membresias();

		        while ($reg = $query->fetch_object()) {
		            echo '<option value=' . $reg->id_memb . '>' . $reg->des_memb.' S/. '.$reg->precio_memb. '</option>';
					//echo '<option value=' . $reg->id_memb . '>' . $reg->des_memb . '</option>';
		        }

		    break;
	}
		