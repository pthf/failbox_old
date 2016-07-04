<?php 
session_start();
  if(!isset($_SESSION['idAdmin']))
    header("Location: index.php");
  require_once("../db/conexion.php");

$id_product = $_GET['id'];
$estatus = $_GET['estatus'];

$query = "UPDATE Productos SET Estatus = '".$estatus."' WHERE IdProducto = '".$id_product."'";
	$resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error());

echo"
	<script type='text/javascript'>
		window.location='../edit/editProducts.php';
	</script>";

?>