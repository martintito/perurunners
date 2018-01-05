<?php
	function add_inventory($product_id,$product_quantity){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"select * from inventory where product_id='".$product_id."'");//Consulta para verificar si el producto se encuentra reguistrado en  el inventario
		$count=mysqli_num_rows($sql);
		if ($count==0){
			$insert=mysqli_query($con,"insert into inventory (product_id, product_quantity) values ('$product_id','$product_quantity')");//Ingresa un nuevo producto al inventario
		} else {
			$sql2=mysqli_query($con,"select * from inventory where product_id='".$product_id."'");
			$rw=mysqli_fetch_array($sql2);
			$old_qty=$rw['product_quantity'];//Cantidad encontrada en el inventario
			$new_qty=$old_qty+$product_quantity;//Nueva cantidad en el inventario
			$update=mysqli_query($con,"UPDATE inventory SET product_quantity='".$new_qty."' WHERE product_id='".$product_id."'");//Actualizo la nueva cantidad en el inventario
		}
	}
	
	function remove_inventory($product_id,$product_quantity){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"select * from inventory where product_id='".$product_id."'");
		$rw=mysqli_fetch_array($sql);
		$old_qty=$rw['product_quantity'];//Cantidad encontrada en el inventario
		$new_qty=$old_qty-$product_quantity;//Nueva cantidad en el inventario
		$update=mysqli_query($con,"UPDATE inventory SET product_quantity='".$new_qty."' WHERE product_id='".$product_id."'");//Actualizo la nueva cantidad en el inventario
	}
	function update_buying_price($product_id,$buying_price){
		global $con;//Variable de conexion
		$update=mysqli_query($con,"UPDATE products SET buying_price='".$buying_price."' WHERE product_id='".$product_id."'");
	}
	
	function get_stock($product_id){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"SELECT 	product_quantity FROM inventory WHERE product_id='".$product_id."'");
		$rw=mysqli_fetch_array($sql);
		$stock=number_format($rw['product_quantity'],2);
		return $stock;
	}
	function is_service($product_id){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"select * from products where product_id='".$product_id."' and is_service='1'");
		$count=mysqli_num_rows($sql);
		return $count;
	}
	function add_sale_product($sale_id,$product_id,$qty,$discount, $unit_price){
		global $con;//Variable de conexion
		$insert=mysqli_query($con, "INSERT INTO sale_product (sale_id,product_id,qty,discount,unit_price) VALUES ('$sale_id','$product_id','$qty','$discount','$unit_price')");
	}
	function orderToInvoice($order_id,$sale_id){
		global $con;//Variable de conexion
		$sql=mysqli_query($con, "select * from products, order_product where products.product_id=order_product.product_id and order_product.order_id='$order_id'");
		while ($row=mysqli_fetch_array($sql)){
			$product_id=$row['product_id'];
			$qty=$row['qty'];
			$discount=$row['discount'];
			$unit_price=$row['unit_price'];
			add_sale_product($sale_id,$product_id,$qty,$discount,$unit_price);//Guardo los datos en la tabla sale_product
			$is_service= is_service($product_id);
			if ($is_service==0){//SINO es un servicio
				remove_inventory($product_id,$qty );//Disminuye la cantidad en el inventario;
			}
		}
	
	}
	function get_id($table,$row,$condition,$equal){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"select $row from $table where $condition='$equal' limit 0,1");
		$rw=mysqli_fetch_array($sql);
		$result= $rw[$row];
		return $result;
	} 
	function update_table($table,$row,$value,$condition,$equal){
		global $con;//Variable de conexion
		$sql=mysqli_query($con,"update $table SET $row='$value' where $condition='$equal'");
	}
	
	function quoteToInvoice($quote_id,$sale_id){
		global $con;//Variable de conexion
		$sql=mysqli_query($con, "select * from products, quote_product where products.product_id=quote_product.product_id and quote_product.quote_id='$quote_id'");
		while ($row=mysqli_fetch_array($sql)){
			$product_id=$row['product_id'];
			$qty=$row['qty'];
			$discount=$row['discount'];
			$unit_price=$row['unit_price'];
			add_sale_product($sale_id,$product_id,$qty,$discount,$unit_price);//Guardo los datos en la tabla sale_product
			$is_service= is_service($product_id);
			if ($is_service==0){//SINO es un servicio
				remove_inventory($product_id,$qty );//Disminuye la cantidad en el inventario;
			}
		}
	
	}
?>	