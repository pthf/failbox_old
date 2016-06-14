<?php
include ("../login/security.php");
require_once("../db/conexion.php");

editProduct();

function editProduct() {

    parse_str($_POST['action'], $formData);

    date_default_timezone_set('UTC');
    date_default_timezone_set("America/Mexico_City");
    $datatime = date("Y-m-d H:i:s");

    //Arreglo de categorias
    $array_categorys = $formData['categorys'];

    //Realizamos los cambios de los datos a la tabla Productos
    $sql_changes_prod = "UPDATE Productos 
                            SET NombreProd='" . $formData['name_product'] . "', Descripcion='" . $formData['description'] . "', 
                                Stock='" . $formData['stocks'] . "', PrecioLista='" . $formData['pricelist'] . "', 
                                PrecioFailbox='" . $formData['pricefailbox'] . "', Modelo='" . $formData['model'] . "',
                                SKU='" . $formData['sku'] . "', Estatus='" . $formData['estatus'] . "',
                                urlPaypal='" . $formData['url_paypal'] . "',Destacado='" . $formData['outstanding'] . "',
                                FechaAlta='".$datatime."'
							WHERE IdProducto = '" . $formData['id'] . "'";
    $res = mysql_query($sql_changes_prod, Conectar::con()) or die(mysql_error());

    //Eliminamos el Id de las Relaciones con las Categorias que corresponde al Id Producto  para despues actualizar los datos,
    //Esto se hace ya que cuenta con un arreglo de un cierto limite de productos y el update no acepta modificaciones de mas de una insercion
    $sql = "DELETE FROM Productos_has_Categorias WHERE Productos_IdProducto = '" . $formData['id'] . "'";
    $res = mysql_query($sql, Conectar::con()) or die(mysql_error());

    //Ciclo para verificar el arreglo de las categorias y realiza un select para verificar si existe un valor en la base de datos
    //similar al que se esta modificando y de ser asi, no reraliza la insecion. 
    //En caso de que no exista se insertan los valores
    for ($i = 0; $i < count($array_categorys); $i++) {
        $query_cat = "SELECT Categorias_IdCategoria FROM Productos_has_Categorias WHERE Productos_IdProducto='" . $formData['id'] . "' AND Categorias_IdCategoria='" . $array_categorys[$i] . "'";
        $result_query = mysql_query($query_cat, Conectar::con()) or die(mysql_error());
        $row = mysql_num_rows($result_query);

        if ($row != 1) {
            $sql_category = "INSERT INTO Productos_has_Categorias VALUES ('" . $formData['id'] . "', '" . $array_categorys[$i] . "')";
            $res = mysql_query($sql_category, Conectar::con()) or die(mysql_error());
        }
    }
    
    
    //Se realizan los cambios de la marca en la base de datos
    $sql_changes_brand = "UPDATE Productos_has_Marcas SET Productos_IdProducto='" . $formData['id'] . "', Marcas_IdMarca='" . $formData['brand'] . "'
									  WHERE Productos_IdProducto='" . $formData['id'] . "'";
    $res = mysql_query($sql_changes_brand, Conectar::con()) or die(mysql_error());
    
    $id_product = $formData['id'];
    echo $id_product;
}
