<?php
	require "Conexion.php";

	class Combos{
			
		public function __construct(){
		}

		public function Registrar($nombre,$operacion){
			global $conexion;
			$sql = "INSERT INTO tipo_documento(nombre,operacion)
						VALUES('$nombre','$operacion')";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function Modificar($idtipo_documento, $nombre,$operacion){
			global $conexion;
			$sql = "UPDATE tipo_documento set nombre = '$nombre',operacion='$operacion'
						WHERE idtipo_documento = $idtipo_documento";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function Eliminar($idtipo_documento){
			global $conexion;
			$sql = "DELETE FROM tipo_documento WHERE idtipo_documento = $idtipo_documento";
			$query = $conexion->query($sql);
			return $query;
		}

		public function Listar(){
			global $conexion;
			$sql = "SELECT * FROM tipo_documento order by idtipo_documento desc";
			$query = $conexion->query($sql);
			return $query;
		}

		public function Reporte(){
			global $conexion;
			$sql = "SELECT * FROM tipo_documento order by nombre asc";
			$query = $conexion->query($sql);
			return $query;
		}

		public function ListarPersona(){
			global $conexion;
			$sql = "SELECT nombre FROM tipo_documento where operacion='Persona'";
			$query = $conexion->query($sql);
			return $query;
		}

		public function ListarComprobante(){
			global $conexion;
			$sql = "SELECT nombre FROM tipo_documento where operacion='Comprobante'";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function listar_Distritos(){
			global $conexion;
			$sql = "select * from distritos";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function listar_Sedes(){
			global $conexion;
			$sql = "select * from sedes";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function listar_Membresias(){
			global $conexion;
			$sql = "select * from membresia";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function listar_Tipo_Pagos(){
			global $conexion;
			$sql = "select * from tipo_pago";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function listar_Paises(){
			global $conexion;
			$sql = "select * from pais";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function listar_Bancos(){
			global $conexion;
			$sql = "select * from bancos";
			$query = $conexion->query($sql);
			return $query;
		}
	}
