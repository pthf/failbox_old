<?php
require_once("admin/db/conexion.php");

$query = "SELECT * FROM Categorias c INNER JOIN Productos p ON p.Categorias_IdCategoria = c.IdCategoria GROUP BY Categoria";
$resultado = mysql_query($query,Conectar::con()) or die(mysql_error()); 

$menuGeneral = array();
while($fila = mysql_fetch_array($resultado)) { 
    
    $query1 = "SELECT * FROM Subcategoria s WHERE Categorias_IdCategoria = '".$fila['IdCategoria']."'";
    $resultado1 = mysql_query($query1,Conectar::con()) or die(mysql_error()); 

    $subcategorias = array();
    while($fila1 = mysql_fetch_array($resultado1)) { 

        $query2 = "SELECT * FROM Marcas m INNER JOIN Productos p ON p.Marcas_IdMarca = m.IdMarca WHERE IdMarca = '".$fila['Marcas_IdMarca']."'";
        $resultado2 = mysql_query($query2,Conectar::con()) or die(mysql_error());

        $marcas = array();
        while($fila2 = mysql_fetch_array($resultado2)) { 
            $marca = $fila2['Marca'];
            array_push($marcas, $marca);
        }

        $subcategoria = 
            array(
                $fila1['Subcategoria'] =>
                    $marcas,
            );
        array_push($subcategorias, $subcategoria);
    }

    $menu = 
        array(
            $fila['Categoria'] =>  
                $subcategorias,
        );
    array_push($menuGeneral, $menu);
}
    echo "<pre>";
    var_dump($menuGeneral);
    echo "</pre>";
    print_r(json_encode($menuGeneral));
