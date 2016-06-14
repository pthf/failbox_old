<?php 
include ("../login/security.php");
require_once("../db/conexion.php");
 
//consulta todos los empleados
$query = "SELECT * FROM Caracteristicas";
$resultado = mysql_query($query,Conectar::con()) or die(mysql_error());
  echo "<select id='characteristic' name='type_characteristic' class='form-control'>";
//echo "<option>Selecciona..</option>";
while($fila=mysql_fetch_array($resultado)){ 
  echo "<option value='".$fila['IdCaracteristica']."'>".$fila['NombreCaracteristica']."</option>";
}
  echo "</select>";