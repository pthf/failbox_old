<?php
require_once("admin/db/conexion.php");

if (isset($_POST['nameCategory']) && isset($_POST['nameSubcategory']) && isset($_POST['nameBrand'])) {

    $query = "SELECT * FROM Productos p 
                INNER JOIN Marcas m ON m.IdMarca = p.Marcas_IdMarca
                INNER JOIN Categorias c ON c.IdCategoria = p.Categorias_IdCategoria
                INNER JOIN Subcategoria s ON s.IdSubcategoria = p.Subcategoria_IdSubcategoria
                WHERE c.Categoria = '".$_POST['nameCategory']."' AND s.Subcategoria = '".$_POST['nameSubcategory']."' AND m.Marca = '".$_POST['nameBrand']."'";
    $resultado = mysql_query($query, Conectar::con()) or die(mysql_error());

    while ($row = mysql_fetch_array($resultado)) { 

        $array_images = explode(',', $row['Image']);

        $producto = array(
                    "id" => $row['IdProducto'],
                    "name" => $row['NombreProd'],
                    "descripcion" => $row['Descripcion'],
                    "marca" => $row['Marca'],
                    "price" => $row['PrecioLista'],
                    "not_price" => $row['PrecioFailbox'],
                    "image" => $array_images[0],
                    "images_slider" => $array_images,
                    "paypal" => $row['urlPaypal'],
        );
        $productos[] = $producto;
    }
} else if (isset($_POST['nameCategory']) && isset($_POST['nameSubcategory'])) {
    $query = "SELECT * FROM Productos p 
                INNER JOIN Marcas m ON m.IdMarca = p.Marcas_IdMarca
                INNER JOIN Categorias c ON c.IdCategoria = p.Categorias_IdCategoria
                INNER JOIN Subcategoria s ON s.IdSubcategoria = p.Subcategoria_IdSubcategoria
                WHERE c.Categoria = '".$_POST['nameCategory']."' AND s.Subcategoria = '".$_POST['nameSubcategory']."'";
    $resultado = mysql_query($query, Conectar::con()) or die(mysql_error());

    while ($row = mysql_fetch_array($resultado)) { 

        $array_images = explode(',', $row['Image']);

        $producto = array(
                    "id" => $row['IdProducto'],
                    "name" => $row['NombreProd'],
                    "descripcion" => $row['Descripcion'],
                    "marca" => $row['Marca'],
                    "price" => $row['PrecioLista'],
                    "not_price" => $row['PrecioFailbox'],
                    "image" => $array_images[0],
                    "images_slider" => $array_images,
                    "paypal" => $row['urlPaypal'],
        );
        $productos[] = $producto;
    }
} else if (isset($_POST['nameCategory'])) {
    $query = "SELECT * FROM Productos p 
                INNER JOIN Marcas m ON m.IdMarca = p.Marcas_IdMarca
                INNER JOIN Categorias c ON c.IdCategoria = p.Categorias_IdCategoria
                INNER JOIN Subcategoria s ON s.IdSubcategoria = p.Subcategoria_IdSubcategoria
                WHERE c.Categoria = '".$_POST['nameCategory']."'";
    $resultado = mysql_query($query, Conectar::con()) or die(mysql_error());

    while ($row = mysql_fetch_array($resultado)) { 

        $array_images = explode(',', $row['Image']);

        $producto = array(
                    "id" => $row['IdProducto'],
                    "name" => $row['NombreProd'],
                    "descripcion" => $row['Descripcion'],
                    "marca" => $row['Marca'],
                    "price" => $row['PrecioLista'],
                    "not_price" => $row['PrecioFailbox'],
                    "image" => $array_images[0],
                    "images_slider" => $array_images,
                    "paypal" => $row['urlPaypal'],
        );
        $productos[] = $producto;
    }
} else {
    $query = "SELECT * FROM Productos p 
                INNER JOIN Marcas m ON m.IdMarca = p.Marcas_IdMarca
                INNER JOIN Categorias c ON c.IdCategoria = p.Categorias_IdCategoria
                INNER JOIN Subcategoria s ON s.IdSubcategoria = p.Subcategoria_IdSubcategoria";
    $resultado = mysql_query($query, Conectar::con()) or die(mysql_error());

    while ($row = mysql_fetch_array($resultado)) { 

        $array_images = explode(',', $row['Image']);

        $producto = array(
                    "id" => $row['IdProducto'],
                    "name" => $row['NombreProd'],
                    "descripcion" => $row['Descripcion'],
                    "marca" => $row['Marca'],
                    "price" => $row['PrecioLista'],
                    "not_price" => $row['PrecioFailbox'],
                    "image" => $array_images[0],
                    "images_slider" => $array_images,
                    "paypal" => $row['urlPaypal'],
        );
        $productos[] = $producto;
    }
}
$arrayList = array();
$arrayGroup = array();
$counter = 0;
foreach ($productos as $key => $value) {
    array_push($arrayGroup, $value);
    if($counter==8){
        array_push($arrayList, $arrayGroup);
        $counter = 0; 
        unset($arrayGroup);
        $arrayGroup = array();
    }else{
        $counter++;
    }
}

if(count($arrayGroup)>0){
    array_push($arrayList, $arrayGroup);
    $counter = 0; 
    unset($arrayGroup);
    $arrayGroup = array();
}

for ($i=0; $i < count($arrayList); $i++) { 
    $item[] = 
    array(
        array(
            "group" => $i,
            "data" => $arrayList[$i],
        ),
    );
    
}
print_r(json_encode($item));
?>