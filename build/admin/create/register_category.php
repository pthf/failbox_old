<?php 
include ("../login/security.php");
require_once("../db/conexion.php");
 
//variables POST
$category = $_POST['other_category'];
$lower_category = strtolower($category);
$capital_category = ucwords($lower_category);

if ($capital_category == "" || $capital_category == NULL) {

	echo "<span style='color:red'>Ingrese una categoria!!</span><br>";

} else {

	$query = "SELECT Categoria FROM Categorias WHERE Categoria = '".$capital_category."'"; 
	$result_query = mysql_query($query,Conectar::con()) or die(mysql_error());
	$row = mysql_num_rows($result_query);

	if ($row == 1) { 

		echo "<span style='color:red'>Ya existe la categoria, intente de nuevo!!</span><br>";

	} else { 

		//registra las categorias de los productos
		$sql = "INSERT INTO Categorias (IdCategoria, Categoria) VALUES ('', '".$capital_category."')";
		$resultado_consulta_mysql = mysql_query($sql,Conectar::con()) or die(mysql_error());
		
	}

}

include('consult_category.php');

?>