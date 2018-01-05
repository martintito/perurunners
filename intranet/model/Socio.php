<?php
	require "Conexion.php";

	class Socio{
			
		public function __construct(){
		}

		public function Registrar($pat,$mat,$nom,$doc,$num,$dir,$mail,$tel,$cel,$civil,$fec,$gen,$talp,$talz,$corre,$foto,
		$disca,$club,$conta,$telcon,$tiptar,$numtar,$est,$pais,$dis,$sede,$mem,$banco){
			global $conexion;
			$sql="insert into socio values(0,'$pat','$mat','$nom','$doc','$num','$dir','$mail','$tel','$cel','$civil',CURRENT_TIMESTAMP,'$fec','$gen','$talp','$talz',
			'$corre','$foto','$disca','$club','$conta','$telcon','$tiptar','$numtar','$num','$num','$est',
			'$pais','$dis','$sede','$mem','$banco')";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function Modificar($id,$dir,$mail,$tel,$cel,$civil,$talp,$talz,$foto,$conta,
		$telcon,$tiptar,$numtar,$login,$clave,$dis,$sede,$banco){
			global $conexion;
			
			$sql = "UPDATE socio set direccion='$dir',email='$mail',telef_fijo='$tel',telef_celu='$cel',est_civil='$civil',talla_polo='$talp',talla_zapa='$talz',foto_socio='$foto',
			nom_contacto='$conta',telef_contacto='$telcon',tipo_tarjeta='$tiptar',num_tarjeta='$numtar',login='$login',clave='$clave',id_dist='$dis',id_sede='$sede',id_banco='$banco' WHERE idsocio = $id";
					
			$query = $conexion->query($sql);
			return $query;
		}	
		public function Modificar2($id,$pat,$mat,$nom,$doc,$num,$dir,$mail,$tel,$cel,$civil,$fec,$gen,$talp,$talz,
			$corre,$disca,$club,$conta,$telcon,$tiptar,$numtar,$login,$clave,$pais,$dis,$sede,$mem,$banco){
			global $conexion;
			
			$sql = "UPDATE socio set ape_pat='$pat',ape_mat ='$mat',nombres='$nom',tipo_doc='$doc',num_doc='$num',direccion='$dir',email='$mail',
			telef_fijo='$tel',telef_celu='$cel',est_civil='$civil', fecha_nac='$fec',genero='$gen',talla_polo='$talp',talla_zapa='$talz',correrxsem='$corre',
			discapacidad='$disca',miembro_club='$club',nom_contacto='$conta',telef_contacto='$telcon',tipo_tarjeta='$tiptar',num_tarjeta='$numtar',login='$login',clave='$clave',id_pais='$pais',id_dist='$dis',id_sede='$sede',
			id_memb='$mem',id_banco='$banco' WHERE idsocio = $id";
					
			$query = $conexion->query($sql);
			return $query;
		}	
		public function Modificar3($tiptar,$numtar,$sede,$mem,$banco,$estado,$id){
			global $conexion;
			
			$sql = "UPDATE socio set tipo_tarjeta='$tiptar',num_tarjeta='$numtar',id_sede='$sede',id_memb='$mem',id_banco='$banco',estado='$estado' WHERE idsocio = $id";
					
			$query = $conexion->query($sql);
			return $query;
		}			
		public function Eliminar($idsocio){
			global $conexion;
			$sql = "DELETE FROM socio WHERE idsocio = $idsocio";
			$query = $conexion->query($sql);
			return $query;
		}

		public function Listar(){
			global $conexion;
			$sql = "SELECT * FROM socio so INNER JOIN pais pa ON so.id_pais=pa.id_pais INNER JOIN distritos di ON so.id_dist=di.id_distrito INNER JOIN sedes se ON so.id_sede=se.id_sede INNER JOIN bancos ba ON so.id_banco=ba.id_banco where estado='A'";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function listarSocio(){
			global $conexion;
			$sql = "SELECT * FROM socio so INNER JOIN pais pa ON so.id_pais=pa.id_pais INNER JOIN distritos di ON so.id_dist=di.id_distrito INNER JOIN sedes se ON so.id_sede=se.id_sede INNER JOIN bancos ba ON so.id_banco=ba.id_banco where estado='A'";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function Reporte(){
			global $conexion;
			$sql = "SELECT * FROM empleado order by apellidos asc";
			$query = $conexion->query($sql);
			return $query;
		}		
		public function ListMem1($id){
			global $conexion;
			$sql = "SELECT * FROM membresia WHERE id_memb=$id";
			$query = $conexion->query($sql);
			return $query;
		}
	}
