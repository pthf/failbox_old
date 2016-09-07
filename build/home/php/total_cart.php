<?php 
session_start();
if (isset($_SESSION['total_carrito'])) {
	$total_price = 0;
	$costo_envio = 0;
	foreach ($_SESSION['carrito'] as $key => $value) {
		$total_price = $total_price + $_SESSION['carrito'][$key]["sub_total"];
	 	$costo_envio = $costo_envio + $_SESSION['carrito'][$key]['costo_envio'];
	 	$total = $total_price + $costo_envio;
		
	}
	print_r(json_encode($total));
}
?>