<?php 
  if(!isset($_SESSION['idAdmin']))
    header("Location: index.php");
  require_once("../db/conexion.php");
 
$query = "SELECT * FROM Caracteristicas ORDER BY NombreCaracteristica ASC";
$resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
  echo "<select id='characteristic' name='type_characteristic' class='form-control'>";
//echo "<option>Selecciona..</option>";
while($fila=mysqli_fetch_array($resultado)){ 
  echo "<option value='".$fila['IdCaracteristica']."'>".$fila['NombreCaracteristica']."</option>";
}
  echo "</select>";