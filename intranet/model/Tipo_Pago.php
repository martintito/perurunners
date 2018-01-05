<?php
	require "Conexion.php";

	class Tipo_Pago{
	
		
		public function __construct(){
		}

		public function Registrar($nombre,$moneda,$monto){
			global $conexion;
			$sql = "INSERT INTO tipo_pago(descrip_pago,moneda,monto)
						VALUES('$nombre','$moneda',$monto)";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function Modificar($idtipo,$nombre,$moneda,$monto){
			global $conexion;
			$sql = "UPDATE tipo_pago set descrip_pago = '$nombre', moneda = '$moneda', monto = $monto WHERE id_tipo_pago = $idtipo";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function Eliminar($idtipo){
			global $conexion;
			$sql = "DELETE FROM tipo_pago WHERE id_tipo_pago = $idtipo";
			$query = $conexion->query($sql);
			return $query;
		}

		public function Listar(){
			global $conexion;
			$sql = "SELECT * FROM tipo_pago order by id_tipo_pago desc";
			//$sql = "SELECT * FROM pagos";
			$query = $conexion->query($sql);
			return $query;
		}

		public function Reporte(){
			global $conexion;
			$sql = "SELECT * FROM tipo_pago order by descrip_pago asc";
			$query = $conexion->query($sql);
			return $query;
		}
		

	}
