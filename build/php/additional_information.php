<?php
require_once("../admin/db/conexion.php");

if (isset($_POST['id'])) {

	$query = "SELECT * FROM Productos p INNER JOIN Marcas m ON m.IdMarca = p.Marcas_IdMarca WHERE IdProducto = '".$_POST['id']."' AND Estatus = 'Activo'";
	$resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error());

	$productos = array();
	while ($row = mysqli_fetch_array($resultado)) {
	    $producto =
	        array(
	            "sku" => $row['SKU'],
	            "marca" => $row['Marca'],
	            "modelo" => $row['Modelo'],
	        );
	    $productos[] = $producto;
	}
	print_r(json_encode($productos));

}
?>
