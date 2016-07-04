<?php 
  if(!isset($_SESSION['idAdmin']))
    header("Location: index.php");
  require_once("../db/conexion.php");

$query = "SELECT * FROM Subcategorias";
$resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error());
 	echo "<select name='subcategory' id='selectSubCategory' class='form-control' required>";
	echo "<option disabled selected>Selecciona..</option>";
while($row=mysqli_fetch_array($resultado)){
 	echo "<option value='".$row['IdSubcategoria']."'>".$row['Subcategoria']."</option>";
}
  	echo "</select>";

?>

