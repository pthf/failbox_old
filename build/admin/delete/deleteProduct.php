<?php 
include ("../login/security.php");
require_once("../db/conexion.php");

$id_product = $_GET['id'];

$sql_brand = "DELETE FROM Productos_has_Marcas WHERE Productos_IdProducto = '".$id_product."'";
	$res_brand = mysql_query($sql_brand,Conectar::con()) or die(mysql_error());

$sql_category = "DELETE FROM Productos_has_Categorias WHERE Productos_IdProducto = '".$id_product."'";
	$res_category = mysql_query($sql_category,Conectar::con()) or die(mysql_error());

$sql_charact = "DELETE FROM Productos_has_Caracteristicas WHERE Productos_IdProducto = '".$id_product."'";
	$res_charact = mysql_query($sql_charact,Conectar::con()) or die(mysql_error());

$sql_product = "DELETE FROM Productos WHERE IdProducto = '".$id_product."'";
	$res_product = mysql_query($sql_product,Conectar::con()) or die(mysql_error());

echo"
	<script type='text/javascript'>
		alert('El producto se elimino correctamente..!');
		window.location='../edit/editProducts.php';
	</script>";

?>