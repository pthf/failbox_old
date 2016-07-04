<?php 
session_start();
  if(!isset($_SESSION['idAdmin']))
    header("Location: index.php");
  require_once("../db/conexion.php");

$id_product = $_GET['id'];
$id_imagen = $_GET['imagen'];

$sql_charact = "DELETE FROM Productos_has_Imagenes WHERE IdImagen = '".$id_imagen."'";
	$res_charact = mysqli_query(Conectar::con(),$sql_charact) or die(mysqli_error());

$query = "SELECT * FROM Productos_has_Imagenes WHERE Productos_IdProducto = '".$id_product."'";
$resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error());

$array_images = array();
while ($row = mysqli_fetch_array($resultado)) {
	array_push($array_images, $row['NombreImagen']);
}

$imagenes = implode(',', $array_images);
$query3 = "UPDATE Productos SET Image = '".$imagenes."' WHERE IdProducto = '".$id_product."'";
    $resultado3 = mysqli_query(Conectar::con(),$query3) or die(mysqli_error());

echo"
	<script type='text/javascript'>
		window.location='../create/createCharacteristics.php?id=$id_product';
	</script>";

?>