<?php

require "Conexion.php";

class articulo {

    public function __construct() {
        
    }

    public function Registrar($idcategoria, $idunidad_medida, $nombre, $descripcion, $imagen) {
        global $conexion;
        $sql = "INSERT INTO articulo(idcategoria, idunidad_medida, nombre, descripcion, imagen, estado)
						VALUES($idcategoria, $idunidad_medida, '$nombre', '$descripcion', '$imagen', 'A')";
        $query = $conexion->query($sql);
        return $query;
    }

    public function Modificar($idarticulo, $idcategoria, $idunidad_medida, $nombre, $descripcion, $imagen) {
        global $conexion;
        $sql = "UPDATE articulo set idcategoria = $idcategoria, idunidad_medida = $idunidad_medida, nombre = '$nombre',
						descripcion = '$descripcion', imagen = '$imagen'
						WHERE idarticulo = $idarticulo";
        $query = $conexion->query($sql);
        return $query;
    }

    public function Eliminar($idarticulo) {
        global $conexion;
        $sql = "UPDATE articulo set estado = 'N' WHERE idarticulo = $idarticulo";
        $query = $conexion->query($sql);
        return $query;
    }

//    public function Listar() {
//        global $conexion;
//        $sql = "select a.*, c.nombre as categoria, um.nombre as unidadMedida 
//	from articulo a inner join categoria c on a.idcategoria = c.idcategoria
//	inner join unidad_medida um on a.idunidad_medida = um.idunidad_medida where a.estado = 'A' order by idarticulo desc";
//        $query = $conexion->query($sql);
//        return $query;
//    }

    public function Listar() {
        global $conexion;
//        $sql = "select a.*, c.nombre as categoria, um.nombre as unidadMedida, "
//                . "di.*, (di.stock_ingreso * di.precio_compra) as sub_total "
//                . "from articulo a inner join categoria c on a.idcategoria = c.idcategoria "
//                . "inner join unidad_medida um on a.idunidad_medida = um.idunidad_medida "
//                . "inner join detalle_ingreso di on a.idarticulo = di.idarticulo "
//                . "inner join ingreso ing on ing.idingreso = di.idingreso "
//                . "where a.estado = 'A' and ing.estado = 'A' order by a.idarticulo desc";
        
        $sql = "select a.*, c.nombre as categoria, um.nombre as unidadMedida, di.precio_compra, di.precio_ventadistribuidor, di.precio_ventapublico, di.stock_actual, (di.stock_ingreso * di.precio_compra) as sub_total from articulo a inner join categoria c on a.idcategoria = c.idcategoria inner join unidad_medida um on a.idunidad_medida = um.idunidad_medida left join (detalle_ingreso di inner join ingreso ing on ing.idingreso = di.idingreso and ing.estado = 'A') on a.idarticulo = di.idarticulo where a.estado = 'A' ORDER BY `a`.`idarticulo` DESC";
//original        
//        $sql = "select a.*, c.nombre as categoria, um.nombre as unidadMedida from articulo a inner join categoria c on a.idcategoria = c.idcategoria inner join unidad_medida um on a.idunidad_medida = um.idunidad_medida where a.estado = 'A' order by idarticulo desc";
        
        $query = $conexion->query($sql);      
        
        return $query;
    }

    public function Reporte() {
        global $conexion;
        $sql = "select a.*, c.nombre as categoria, um.nombre as unidadMedida 
	from articulo a inner join categoria c on a.idcategoria = c.idcategoria
	inner join unidad_medida um on a.idunidad_medida = um.idunidad_medida where a.estado = 'A' order by a.nombre asc";
        $query = $conexion->query($sql);
        return $query;
    }
    
    public function Detalle($idarticulo) {
        global $conexion;
        $sql = "select a.idarticulo, a.nombre as nombre, c.idcategoria, c.nombre as categoria, um.idunidad_medida, um.nombre as unidad_medida "
                . "from articulo a inner join categoria c on a.idcategoria = c.idcategoria "
                . "inner join unidad_medida um on a.idunidad_medida = um.idunidad_medida "
                . "where a.idarticulo = $idarticulo";
        $query = $conexion->query($sql);
        return $query;
    }

}
