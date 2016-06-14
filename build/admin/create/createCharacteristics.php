<?php 
    include ("../login/security.php");
    require_once("../db/conexion.php");
    $id_producto = $_GET['id'];
?> 
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FAILBOX! | Admin</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!--Plugin para los iconos-->
        <link href="../fonts/css/font-awesome.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="../css/custom.css" rel="stylesheet">
        <link href="../css/icheck/flat/green.css" rel="stylesheet">
        <link href="../css/fileinput.css" rel="stylesheet">

        <script src="../js/jquery.min.js"></script>
        <script src="../js/fileinput.js"></script>
        <script src="../js/ajax.js"></script>
        <script>
         $(function(){   
           $("#image").on("change", function(){
               /* Limpiar vista previa */
               $("#vista-previa").html('');
               var archivos = document.getElementById('image').files;
               var navegador = window.URL || window.webkitURL;
               /* Recorrer los archivos */
               for(x=0; x<archivos.length; x++)
               {
                   /* Validar tamaño y tipo de archivo */
                   var size = archivos[x].size;
                   var type = archivos[x].type;
                   var name = archivos[x].name;
                   if (size > 1024*1024)
                   {
                       $("#vista-previa").append("<p style='color: red'>El archivo "+name+" supera el máximo permitido 1MB</p>");
                       $('#vista-previa').hide(8000);
                   }
                   else if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png' && type != 'image/gif')
                   {
                       $("#vista-previa").append("<p style='color: red'>El archivo "+name+" no es del tipo de imagen permitida.</p>");
                       $('#vista-previa').hide(8000);
                   }
                   else
                   {
                     var objeto_url = navegador.createObjectURL(archivos[x])
                     $("#vista-previa").append("<img src="+objeto_url+" width='250px' height='250px'>");
                   }
               }
           });
           
           $("#btn").on("click", function(){
                var formData = new FormData($("#formulario")[0]);
                var ruta = "../class/functionImage.php";
                var id = "<?php echo $id_producto?>";
                $.ajax({
                    url: ruta+"?id="+id,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(datos)
                    {
                        $("#respuesta").html(datos);
                        $('#respuesta').show();
                        $('#respuesta').hide(8000);
                    }
                });
               });
           
         });
        </script>
    </head>


    <body class="nav-md">

        <div class="container body">


            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;">
                            <a href="../listProducts.php" class="site_title"><i class="fa fa-send"></i> <span>Failbox</span></a>
                            <!--<a href="index3.html"><img src="images/failbox-04.svg"></a>-->
                        </div>
                        <div class="clearfix"></div>


                        <!-- menu prile quick info -->
                        <div class="profile">
                            <div class="profile_pic">
                                <img src="../images/user.png" alt="" class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Bienvenido</span>
                            </div>
                        </div>
                        <!-- /menu prile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                            <div class="menu_section">
                                <h3>Administrador</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> Productos <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="../listProducts.php">Listar Productos</a>
                                            </li>
                                            <li><a href="createProducts.php">Crear</a>
                                            </li>
                                            <li><a href="../edit/editProducts.php">Editar</a>
                                            </li>
                                            <!--<li><a href="index3.html">Eliminar</a>
                                            </li>-->
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->
                    </div>
                </div>
                <!-- top navigation -->
                <div class="top_nav">

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="../images/user.png" alt="">Administrador
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="#">  Perfil</a>
                                        </li>
                                        <li><a href="../login/logout.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesion</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">

                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>
                                    Imagenes
                                    <small>
                                        Sube las imagenes del producto.
                                    </small>
                                </h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content"> 
                                        <div class="tab-content"> 
                                            <div class="col-sm-5"><br>
                                                <form method="post" id="formulario" enctype="multipart/form-data">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="new_characteristic">Subir imagen: 
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="file" id="image" name="image[]" multiple required>
                                                        <p class="help-block"> Subir imagenes de tipo jpeg, jpg, png y tamaño minimo de 60 x 500 pixels.</p>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                        <button class="btn btn-info" type="button" id="btn">Subir imágenes</button>
                                                    </div> 
                                                </form>
                                                <div id="vista-previa"></div>
                                                <div id="respuesta"></div>
                                             </div> 
                                            <div class="col-sm-5">
                                                <table class="table table-striped text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Imagen</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $query2 = "SELECT * FROM Productos_has_Imagenes WHERE Productos_IdProducto = '".$id_producto."'";
                                                        $resultado2 = mysql_query($query2,Conectar::con()) or die(mysql_error());

                                                        while($fila1 = mysql_fetch_array($resultado2)) { ?>
                                                        <tr>
                                                            <td><?php echo $fila1['NombreImagen']; ?></td>
                                                            <td>
                                                                <img src="../images/products/<?php echo $fila1['NombreImagen']; ?>" alt="..." style="width: 70px; height: 60px;">
                                                            </td>
                                                            <td><a href="../delete/deleteImage.php?id=<?php echo $id_producto; ?>&imagen=<?php echo $fila1['IdImagen']?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Eliminar </a></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-title">
                            <div class="title_left">
                                <h3>
                                    Caracteristicas
                                    <small>
                                        Crea las caracteristicas del producto.
                                    </small>
                                </h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content"> 
                                        <div class="tab-content">
                                            <div class="tab-pane fade active in">
                                                <div class="col-sm-5"><br>
                                                    <div class="form-group">
                                                        <form name="new_characteristic" action="" onsubmit="sendCharacteristic(); return false">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="new_characteristic">Nueva Caracteristica *
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input required id="new_characteristic" class="form-control col-md-7 col-xs-12" type="text" name="new_characteristic" placeholder="Tipo caracteristica">
                                                                <p class="help-block"> Ejemplo: color, tamaño, peso, etc.</p>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <button type="submit" value"Grabar" class="btn btn-info">Añadir Caracteristica</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <table class="table table-striped">
                                                        <thead>
                                                          <tr>
                                                            <th>Tipo</th>
                                                            <th>Caracteristica</th>
                                                            <th></th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                        $query = "SELECT * FROM Productos p
                                                                    INNER JOIN Productos_has_Caracteristicas phc 
                                                                        ON phc.Productos_IdProducto = p.IdProducto
                                                                    INNER JOIN Caracteristicas ca 
                                                                        ON ca.IdCaracteristica = phc.Caracteristicas_IdCaracteristica
                                                                    WHERE p.IdProducto = '".$id_producto."'";
                                                        $resultado = mysql_query($query,Conectar::con()) or die(mysql_error());
                                                        while($fila=mysql_fetch_array($resultado)) { ?>
                                                          <tr>
                                                            <td><?php echo $fila['NombreCaracteristica']; ?></td>
                                                            <td><?php echo $fila['DetalleCaracteristica']; ?></td>
                                                            <td><a href="../delete/deleteCharacteristics.php?id=<?php echo $id_producto; ?>&caracteristica=<?php echo $fila['Caracteristicas_IdCaracteristica']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Eliminar </a></td>
                                                          </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <form class="form-horizontal form-label-left" action="saveCharacteristics.php?id=<?php echo $id_producto;?>" method="POST">
                                                    <div class="col-sm-5"><br>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_characteristic">Tipo Caracteristica *  
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div id="result_characteristic"><?php include('consult_characteristic.php');?></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="characteristic">Caracteristica *
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" min="0" id="characteristic" name="characteristic" required="" class="form-control col-md-7 col-xs-12" placeholder="Tipo caracteristica">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-3">
                                                                <a href="../listProducts.php" class="btn btn-danger">Cancelar </a>  
                                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                                                <a href="../listProducts.php" class="btn btn-warning">Finalizar</a>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ln_solid"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- /page content -->

                    <!-- footer content -->
                    <footer>
                      <div class="pull-right">
                        ©2016 FAILBOX - Website by <a href="https://colorlib.com">PTHF</a>
                      </div>
                      <div class="clearfix"></div>
                    </footer>
                    <!-- /footer content -->
                </div>
            </div>

            <div id="custom_notifications" class="custom-notifications dsp_none">
                <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
                </ul>
                <div class="clearfix"></div>
                <div id="notif-group" class="tabbed_notifications"></div>
            </div>

            <script src="../js/bootstrap.min.js"></script>

            <script src="../js/custom.js"></script>   
    </body>

</html>