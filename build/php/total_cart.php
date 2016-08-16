<?php 
session_start();
if (isset($_SESSION['total_carrito'])) {
	print_r(json_encode($_SESSION['total_carrito']));
}
?>