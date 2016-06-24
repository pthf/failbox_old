<?php
require_once("../admin/db/conexion.php");


if (isset($_GET['search'])) {

	$texto = explode(' ', $_GET['search']);

	$productos = array();
	for ($i=0; $i < count($texto); $i++) {

		if(strlen($texto[$i])>1){
			$query = "SELECT * FROM Productos p
						INNER JOIN Categorias c ON c.IdCategoria = p.Categorias_IdCategoria
						INNER JOIN Subcategoria s ON s.IdSubcategoria = p.Subcategoria_IdSubcategoria
						INNER JOIN Marcas m ON m.IdMarca = p.Marcas_IdMarca
						WHERE p.NombreProd LIKE '" . $texto[$i] . "%'
			            OR p.RouteProd LIKE '" . $texto[$i] . "%'
			            OR c.Categoria LIKE '" . $texto[$i] . "%'
			            OR s.Subcategoria LIKE '" . $texto[$i] . "%'
			            OR m.Marca LIKE '" . $texto[$i] . "%'";

			$resultado = mysql_query($query, Conectar::con()) or die(mysql_error());

			while ($row = mysql_fetch_array($resultado)) {

			array_push($productos, $row);

			}
		}



	}

}

if (isset($productos)) {
	$items = array();
	for ($i=0; $i < count($productos); $i++) {

		$array_images = explode(',', $productos[$i]['Image']);

		$item = array(
			"id" => $productos[$i]['IdProducto'],
            "name" => $productos[$i]['NombreProd'],
            "url" => $productos[$i]['RouteProd'],
            "descripcion" => $productos[$i]['Descripcion'],
            "marca" => $productos[$i]['Marca'],
            "price" => $productos[$i]['PrecioLista'],
            "not_price" => $productos[$i]['PrecioFailbox'],
            "image" => $array_images[0],
            "paypal" => $productos[$i]['urlPaypal'],
		);
		array_push($items, $item);
	}
	print_r(json_encode($items));
}

?>
