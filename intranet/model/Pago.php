<?php
	require "Conexion.php";

	class Pagos{
			
		public function __construct(){
		}

		public function Registrar($id,$usuario,$tipo,$fecha,$monto){
			global $conexion;
			$sql="insert into pagos values(0,$id,$usuario,$tipo,'$fecha',CURRENT_TIMESTAMP,$monto,'A')";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function Modificar($id,$pat,$mat,$nom,$doc,$num,$dir,$mail,$fec,$tel,$talp,$talz,$log,$cla,$est,$dis,$sede,$mem){
			global $conexion;
			$sql = "UPDATE socio set ape_pat = '$pat',ape_mat = '$mat',nombres = '$nom',tipo_doc='$doc',nume_doc='$num', direccion = '$dir' ,telef_fijo	='$tel',email='$mail',fecha_nac='$fec',talla_polo='$talp',talla_zapa='$talz',
					estado='$est',id_dist='$dis',id_sede='$sede',id_memb='$mem',login = '$log', clave = '$cla' WHERE idsocio = $id";
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
			$sql = "SELECT * FROM pagos pa INNER JOIN socio so ON pa.id_socio=so.idsocio INNER JOIN tipo_pago tp
ON pa.id_tipo_pago=tp.id_tipo_pago INNER JOIN sedes se ON so.id_sede=se.id_sede";
			$query = $conexion->query($sql);
			return $query;
		}
		public function listar_Monto_Pago($id){
			global $conexion;
			$sql = "SELECT * FROM tipo_pago WHERE id_tipo_pago=$id";
			$query = $conexion->query($sql);
			return $query;
		}
		public function Reporte(){
			global $conexion;
			$sql = "SELECT * FROM empleado order by apellidos asc";
			$query = $conexion->query($sql);
			return $query;
		}		

	}