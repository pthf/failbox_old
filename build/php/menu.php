<?php
require_once("admin/db/conexion.php");

$query = "SELECT * FROM Categorias c INNER JOIN Productos p ON p.Categorias_IdCategoria = c.IdCategoria";
$resultado = mysql_query($query,Conectar::con()) or die(mysql_error()); 

while($fila = mysql_fetch_array($resultado)) { 

    $query1 = "SELECT * FROM Subcategoria s INNER JOIN Productos p ON p.Subcategoria_IdSubcategoria = s.IdSubcategoria WHERE s.Categorias_IdCategoria = '".$fila['IdCategoria']."'";
    $resultado1 = mysql_query($query1,Conectar::con()) or die(mysql_error()); 
    while ($fila1 = mysql_fetch_array($resultado1)) {
        $Subcategoria[] = array($fila1['Subcategoria']);
    }
    $datos[] = 
        array(
            $fila['Categoria'] => 
                $Subcategoria
        );
}
    echo "<pre>";
    var_dump($datos);
    echo "</pre>";
exit();

//print_r(json_encode($datos));
//print_r(json_encode($datos1));
//print_r(json_encode($datos2));
//exit();

/*$query1 = "SELECT * FROM Categorias c
            INNER JOIN Productos p
            ON p.Categorias_IdCategoria = c.IdCategoria
            INNER JOIN Subcategoria s 
            ON s.IdSubcategoria = p.Subcategoria_IdSubcategoria
            INNER JOIN Marcas m
            ON m.IdMarca = p.Marcas_IdMarca";
$resultado1 = mysql_query($query1,Conectar::con()) or die(mysql_error()); 

while($fila1 = mysql_fetch_array($resultado1)) { 
    $query = "SELECT * FROM Marcas m WHERE IdMarca = '".$fila1['Marcas_IdMarca']."'";
    $resultado = mysql_query($query,Conectar::con()) or die(mysql_error());
    $fila = mysql_fetch_array($resultado);
    
    $datos[] = array(
        $fila1['Categoria'] =>
            array(
                $fila1['Subcategoria'] => 
                array(
                    $fila['Marca'],
                ),
            ),
    );
}

echo "<pre>";
print_r(json_encode($datos));
echo "</pre>";*/