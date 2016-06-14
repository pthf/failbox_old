<?php 
include ("../login/security.php");
require_once("../db/conexion.php");
 
//consulta todos los empleados
$sql = "SELECT * FROM Categorias";
$resultado_consulta_mysql = mysql_query($sql,Conectar::con()) or die(mysql_error());
while($row = mysql_fetch_array($resultado_consulta_mysql)){
  echo "<label class='checkbox-inline'>";
  echo "<input type='checkbox' id=".$row['IdCategoria']." value=".$row['IdCategoria']." name='categorys[]'> ".$row['Categoria']."";
  echo "</label>";
}