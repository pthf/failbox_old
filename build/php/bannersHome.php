<?php
require_once("../admin/db/conexion.php");

$query = "SELECT * FROM BannersHome";
$resultado = mysqli_query(Conectar::con(),$query) or die(mysqli_error());

$banners = array();
while ($row = mysqli_fetch_array($resultado)) {
    $banner =
        array(
            "id" => $row['idBannersHome'],
            "name" => $row['BannersHomeName'],
            "link" => $row['BannersHomeUrl'],
            "image" => $row['BannersHomeImage'],
        );
    $banners[] = $banner;
}
print_r(json_encode($banners));
?>
