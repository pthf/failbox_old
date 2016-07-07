<?php
  require_once("../admin/db/conexion.php");
  $queryCat = "SELECT * FROM Categorias";
  $resultCat = mysqli_query(Conectar::con(),$queryCat) or die(mysqli_error());
  $arrayDataCat = array();
  $arrayDataSubCat = array();
  $arrayDataBrand = array();
  while($lineCat = mysqli_fetch_array($resultCat)){
    $querySubCat = "SELECT * FROM Subcategoria WHERE Categorias_IdCategoria = ".$lineCat['IdCategoria'];
    $resultSubCat = mysqli_query(Conectar::con(),$querySubCat) or die(mysqli_error());
    while($lineSubCat = mysqli_fetch_array($resultSubCat)){
      $queryBrand = "SELECT * FROM Productos INNER JOIN Marcas ON Marcas.IdMarca = Productos.Marcas_IdMarca WHERE Productos.Categorias_IdCategoria = ".$lineCat['IdCategoria']." AND Productos.Subcategoria_IdSubcategoria = ".$lineSubCat['IdSubcategoria']." AND Estatus = 'Activo'";
      $resultBrand = mysqli_query(Conectar::con(),$queryBrand) or die(mysqli_error());
      $arrayBrandRegister = array();
      while($lineBrand = mysqli_fetch_array($resultBrand)){
        $register = false;
        foreach ($arrayBrandRegister as $key => $value) {
          if($lineBrand['Marca'] == $value)
            $register = true;
        }
        if(!$register){
          $dataAuxBrand = array($lineBrand['Marca']  => $lineBrand['IdMarca']);
          array_push($arrayDataBrand, $dataAuxBrand);
          unset($dataAuxBrand);
          array_push($arrayBrandRegister, $lineBrand['Marca']);
        }
      }
      $dataAuxSubCat = array($lineSubCat['Subcategoria'] => $arrayDataBrand);
      array_push($arrayDataSubCat, $dataAuxSubCat);
      unset($dataAuxSubCat);
      unset($arrayDataBrand);
      $arrayDataBrand = array();
    }
    $dataAuxCat = array($lineCat['Categoria']  => $arrayDataSubCat);
    array_push($arrayDataCat, $dataAuxCat);
    unset($dataAuxCat);
    unset($arrayDataSubCat);
    $arrayDataSubCat = array();
  }
  print_r(json_encode($arrayDataCat));
?>
