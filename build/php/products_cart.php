<?php 
session_start();
if (isset($_SESSION['carrito'])) {
	print_r(json_encode($_SESSION['carrito']));
}
// $productos = array();
//     $producto =
//         array(
//             "sku" => 'Hola',
//             "marca" => 'Bebe',
//             "modelo" => 'Guapo'
//         );
//     $productos[] = $producto;
// 	print_r(json_encode($productos));

?>