<?php
require_once("admin/db/conexion.php");

$query = "SELECT * FROM Productos";
$resultado = mysql_query($query, Conectar::con()) or die(mysql_error());

//$productos = array();
while ($row = mysql_fetch_array($resultado)) {
    
    $array_images = explode(',', $row['Image']);
    $query2 = "SELECT * FROM Marcas m
                INNER JOIN Productos p 
                ON p.Marcas_IdMarca = m.IdMarca
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

    /*$contador = 0;
    $limite = count($productos);
    //var_dump($limite);
    
    while($contador < $limite){
        //echo $contador . '<br />';
        $contador++;
    }*/

    /*$x=0;
    while ($x < count($productos)) {
        var_dump($x);
        $x = $x + 1;
    }*/
$item = 
    array( 
        array( 
            "group" => "1", 
            "data" => $productos,
            ),
        );
print_r(json_encode($item));
?>