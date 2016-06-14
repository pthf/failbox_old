<?php require_once 'login/control.php'; 
$usuario = new usuario();
if (isset($_POST['grabar']) and $_POST['grabar']=='si') {
  $usuario->nueva_sesion();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FailBox - Lo que cuenta es de adentro.</title>
	<link rel="shortcut icon" type="image/png" href="../src/images/favicon.png">
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<link rel="stylesheet" type="text/css" href="../css/home_responsive.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">

	<link href="../css/animate.min.css" rel="stylesheet">
  	<!-- Custom styling plus plugins -->
  	<link href="../css/custom.css" rel="stylesheet">
	<!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<body style="background:#F7F7F7;">
	<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>
    <?php
    $host= $_SERVER["HTTP_HOST"];
  	$url= $_SERVER["REQUEST_URI"];
  	$base_url = "http://" . $host . $url;

    /*$hash = password_hash("1qaz2wsx", PASSWORD_DEFAULT);
    date_default_timezone_set('UTC');
    date_default_timezone_set("America/Mexico_City");
    $datatime = date("Y-m-d");

    $query = "INSERT INTO Usuarios VALUES (null,'Admin','Administrador','ad@gmail.com','".$hash."','Administrador','".$datatime."')";
    $resultado = mysql_query($query, Conectar::con()) or die(mysql_error());
    var_dump($query);*/

    /*if (password_verify('1qaz2wsx', $hash)) {
        echo '¡La contraseña es válida!';
    } else {
        echo 'La contraseña no es válida.';
    }*/

  	?>
    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <!--<form action="control.php" method="POST">-->
          <form name="form" action="" method="POST">
            <h1 class="titleLogin">INICIA SESION</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" required="" name="username"/>
            </div>
            <div>
              <input type="hidden" name="grabar" value="si">
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
            </div>
            <tr> 
              <td colspan="2" align="center"> 
                <?php if (isset($_GET["usuario"])=="si") { ?> 
                  <div class="alert alert-danger" role="alert">DATOS INCORRECTOS</div>
                <?php } ?> 
              </td> 
            </tr> 
            <div>
              <input type="submit" class="btn btn-success" value="Inicia sesión" onClick="validar()"> 
              <!--<button type="submit" class="btn btn-success submit">Entrar</button>-->
              <a class="" href="#">Olvidaste tu contraseña?</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">
              <div class="clearfix"></div>
              <br />
              <div>
                <h1 class="bottomLogin"><i class="fa fa-paw" style="font-size: 26px;"></i> FAILBOX!</h1>
                <p class="bottomLogin">©2016 FAILBOX - Website by PTHF</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>
</body>
</html>