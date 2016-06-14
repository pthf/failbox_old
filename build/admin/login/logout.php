<?php 
	session_start(); 
	session_destroy(); 
	echo "
	<script type='text/javascript'>
	 	alert('LA SESION FUE CERRADA CORRECTAMENTE');
		window.location='../index.php';
	</script> ";
?>