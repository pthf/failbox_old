<?php 
session_start();
  if(!isset($_SESSION['idAdmin']))
    header("Location: index.php");
  require_once("../db/conexion.php");

$id_product = $_GET['id'];

$sql_charact = "DELETE FROM Productos_has_Imagenes WHERE Productos_IdProducto = '".$id_product."'";
	$res_charact = mysqli_query(Conectar::con(),$sql_charact) or die(mysqli_error());

$sql_charact = "DELETE FROM Productos_has_Caracteristicas WHERE Productos_IdProducto = '".$id_product."'";
	$res_charact = mysqli_query(Conectar::con(),$sql_charact) or die(mysqli_error());

$sql_product = "DELETE FROM Productos WHERE IdProducto = '".$id_product."'";
	$res_product = mysqli_query(Conectar::con(),$sql_product) or die(mysqli_error());

echo"
	<script type='text/javascript'>
		window.location='../edit/editProducts.php';
	</script>";

?>