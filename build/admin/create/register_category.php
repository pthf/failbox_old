<?php 
session_start();
  if(!isset($_SESSION['idAdmin']))
    header("Location: index.php");
  require_once("../db/conexion.php");
 
//variables POST
$category = $_POST['other_category'];
$lower_category = strtolower($category);
$capital_category = ucwords($lower_category);

if ($capital_category == "" || $capital_category == NULL) {

	echo "<span id='result_subcategory' style='color:red'>Ingrese una categoria!!</span><br>";

} else {

	$query = "SELECT Categoria FROM Categorias WHERE Categoria = '".$capital_category."'"; 
	$result_query = mysql_query($query,Conectar::con()) or die(mysql_error());
	$row = mysql_num_rows($result_query);

	if ($row == 1) { 

		echo "<span class='result_subcategory' style='color:red'>Ya existe la categoria, intente de nuevo!!</span><br>";


	} else { 
		$convert_name = explode(' ', $capital_category);
		$convert_name = strtolower(implode('-', $convert_name));
		$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
		$permitidas= array ("a","e","i","o","u","A","E","I","O","U","N","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E","&");
		$route_name = strtolower(str_replace($no_permitidas, $permitidas ,$convert_name));

		//registra las categorias de los productos
		$sql = "INSERT INTO Categorias (IdCategoria, Categoria, RouteCategoria) VALUES ('', '".$capital_category."', '".$route_name."')";
		$resultado_consulta_mysql = mysql_query($sql,Conectar::con()) or die(mysql_error());
		
	}

}

include('consult_category.php');

?>