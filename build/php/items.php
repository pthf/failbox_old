<?php
require_once("admin/db/conexion.php");

$query = "SELECT * FROM Productos";
$resultado = mysql_query($query, Conectar::con()) or die(mysql_error());

$productos = array();
while ($row = mysql_fetch_array($resultado)) {

    $array_images = explode(',', $row['Image']);
    $query2 = "SELECT p.IdProducto,m.Marca FROM Productos p
                INNER JOIN Productos_has_Marcas pm
                ON pm.Productos_IdProducto = p.IdProducto
                INNER JOIN Marcas m
                ON m.IdMarca = pm.Marcas_IdMarca
                WHERE p.IdProducto = '".$row['IdProducto']."'";
    $resultado2 = mysql_query($query2,Conectar::con()) or die(mysql_error());
    $fila = mysql_fetch_array($resultado2);

    $producto = array(
                "id" => $row['IdProducto'],
                "name" => $row['NombreProd'],
                "descripcion" => $row['Descripcion'],
                "marca" => $fila['Marca'],
                "price" => $row['PrecioLista'],
                "not_price" => $row['PrecioFailbox'],
                "image" => $array_images[0],
                "images_slider" => $array_images,
                "paypal" => $row['urlPaypal'],
    );
    $productos[] = $producto;
}
print_r(json_encode($productos));
?>
