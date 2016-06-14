<?php 
include ("../login/security.php");
require_once("../db/conexion.php");

$id_product = $_GET['id'];
$id_imagen = $_GET['imagen'];

$sql_charact = "DELETE FROM Productos_has_Imagenes WHERE IdImagen = '".$id_imagen."'";
	$res_charact = mysql_query($sql_charact,Conectar::con()) or die(mysql_error());


echo"
	<script type='text/javascript'>
		alert('La imagen se elimino correctamente..!');
		window.location='../create/createCharacteristics.php?id=$id_product';
	</script>";

?>