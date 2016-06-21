<?php 
  session_start();
  if(!isset($_SESSION['idAdmin']))
    header("Location: index.php");
  require_once("../db/conexion.php");
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
                              <h3><?php echo ($_SESSION['idPrivilegio'] == 1) ? 'Administrador' : 'Proveedor' ?></h3>
                              <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Productos <span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu" style="display: none">
                                    <li><a href="../listProducts.php">Productos</a>
                                    </li>
                                    <li><a href="createProducts.php">Crear</a>
                                    </li>
                                    <li><a href="../edit/editProducts.php">Editar</a>
                                    </li>
                                  </ul>
                                </li>
                              </ul>
                              <?php if($_SESSION['idPrivilegio'] == 1) { ?>
                              <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Proveedores <span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu" style="display: none">
                                    <li><a href="../proveedores/listProveedores.php">Proveedores</a>
                                    </li>
                                    <li><a href="#">Crear</a>
                                    </li>
                                    <li><a href="#">Editar</a>
                                    </li>
                                  </ul>
                                </li>
                              </ul>
                              <?php } ?>
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
                                        <img src="../images/user.png" alt=""><?php echo $_SESSION['Usuario']?>
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
                                    Crear Producto
                                    <small>
                                        Crea un nuevo producto con sus caracteristicas.
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
                                            <div class="tab-pane fade active in" id="alta-producto">
                                                <div class=" form-group">
                                                    <form name="new_category" action="" onsubmit="sendCategory(); return false">
                                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="category">Nueva categoría 
                                                        </label>
                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <input required id="other_category" class="form-control col-md-7 col-xs-12" type="text" name="other_category" placeholder="Categoría">
                                                        </div>
                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <button type="submit" value"Grabar" class="btn btn-warning">Agregar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class=" form-group">
                                                    <!--<form name="new_subcategory" action="" onsubmit="sendSubCategory(); return false">-->
                                                    <form name="new_subcategory" id="formNewSubcategory">
                                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="category">Nueva subcategoría 
                                                        </label>
                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                        <?php
                                                            $query = "SELECT * FROM Categorias";
                                                            $resultado = mysql_query($query,Conectar::con()) or die(mysql_error());
                                                                echo "<select id='category' name='category' class='form-control' required>";
                                                                echo "<option disabled selected>Selecciona..</option>";
                                                            while($row2 = mysql_fetch_array($resultado)){
                                                                echo "<option value='".$row2['IdCategoria']."'>". $row2['Categoria']."</option>";
                                                            }
                                                                echo "</select>";
                                                          ?>    
                                                        </div>
                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <input required id="other_subcategory" class="form-control col-md-7 col-xs-12" type="text" name="other_subcategory" placeholder="Subcategoría">
                                                        </div>
                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <button type="submit" value"Grabar" class="btn btn-warning">Agregar</button>
                                                        </div>
                                                    </form>
                                                        <div class="result_subcategory"></div>
                                                        <div class="error_subcategory"></div>
                                                </div>
                                                <div class=" form-group">
                                                    <form name="new_brand" action="" onsubmit="sendBrand(); return false">
                                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" for="brand">Nueva marca 
                                                        </label>
                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <input required id="other_brand" class="form-control col-md-7 col-xs-12" type="text" name="other_brand" placeholder="Marca">
                                                        </div>
                                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                                            <button type="submit" value"Grabar" class="btn btn-warning">Agregar</button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <!--<form class="form-horizontal form-label-left" id="formProduct" name="formProductData" action="saveProducts.php" method="POST" enctype="multipart/form-data">-->
                                                <form class="form-horizontal form-label-left" id="formProduct" name="formProductData" enctype="multipart/form-data">
                                                    <div class="col-sm-5"><br>
                                                        <div class=" form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Categoría   
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div id="result_category"><?php include('consult_category.php');?></div>
                                                            </div>
                                                        </div>
                                                        <div class=" form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Subcategoría   
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select class='form-control' id="selectSubCategory" required name="subcategory">
                                                                    <option disabled selected>Selecciona..</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand">Marca  
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                              <div id="result_brand"><?php include('consult_brand.php');?></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_product">Nombre Producto 
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input id="name_product" class="form-control col-md-7 col-xs-12" name="name_product" placeholder="Nombre del producto" required="" type="text">
                                                            </div>
                                                        </div>
                                                        <div class=" form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Descripción 
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <textarea id="description" required="" rows="5" name="description" class="form-control col-md-7 col-xs-12" placeholder="Escribe la descripcion del producto" ></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stocks">Stocks 
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="number" min="0" id="stocks" name="stocks" required="" class="form-control col-md-7 col-xs-12" placeholder="Cantidad de productos">
                                                            </div>
                                                        </div>
                                                        <!--<div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warranty">Garantía 
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select required class="form-control" name="warranty">
                                                                    <option selected disabled>Selecciona..</option>
                                                                    <option>6 meses</option>
                                                                    <option>1 año</option>
                                                                    <option>2 año</option>
                                                                    <option>3 año</option>
                                                                </select>
                                                            </div>
                                                        </div>-->
                                                    </div>
                                                    <div class="col-sm-5"><br>
                                                        <div class=" form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pricelist">Precio lista $ 
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="number" id="pricelist" name="pricelist" required="" min="0" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12" placeholder="Precio lista MXN">
                                                            </div>
                                                        </div>
                                                        <div class=" form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pricefailbox">Precio failbox $ 
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="number" id="pricefailbox" name="pricefailbox" required="" min="0" data-validate-minmax="10,100" placeholder="Precio failbox MXN" class="form-control col-md-7 col-xs-12">
                                                            </div>
                                                        </div>
                                                        <div class=" form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelo">Modelo 
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input id="model" type="text" name="model" required="" placeholder="Codigo de producto" class="form-control col-md-7 col-xs-12">
                                                            </div>
                                                        </div>
                                                        <div class=" form-group">
                                                            <label for="sku" class="control-label col-md-3">SKU </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input id="sku" type="text" name="sku" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="" placeholder="No. REF. (SKU)">
                                                            </div>
                                                        </div>
                                                        <div class=" form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Estatus 
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select required class="form-control" name="status">
                                                                    <option disabled selected>Selecciona..</option>
                                                                    <option>Activo</option>
                                                                    <option>Inactivo</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="outstanding">¿Producto destacado?
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <select required class="form-control" name="outstanding">
                                                                    <option disabled selected>Selecciona..</option>
                                                                    <option>SI</option>
                                                                    <option>NO</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class=" form-group">
                                                            <label for="url_paypal" class="control-label col-md-3">URL Paypal </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input id="url_paypal" type="text" name="url_paypal" class="form-control col-md-7 col-xs-12" required="" placeholder="URL Paypal">
                                                            </div>
                                                        </div>
                                                        <!--<div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Subir Imagen 
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="file" id="image" name="image[]" value="" required multiple>
                                                                <p class="help-block">Subir unicamente imagenes .jpg, .jpeg, png.</p>
                                                            </div>
                                                        </div>-->
                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-3">
                                                                <a href="../listProducts.php" class="btn btn-danger">Cancelar</a>
                                                                <button type="submit" class="btn btn-primary">Enviar</button>
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

            <script type="text/javascript">
                $("#selectCategory").change(function () {
                    var idCategory = $("option:selected", this).attr('value');
                    var namefunction = 'getStatesUser';
                    $.ajax({
                        url: "../php/functions.php",
                        type: "POST",
                        data: {
                            namefunction: namefunction,
                            idCategory: idCategory
                        },
                        success: function (result) {
                            $('#selectSubCategory').html(result);
                        },
                        error: function () {},
                        complete: function () {},
                        timeout: 10000
                    });
                });
            </script>
            <script src="../js/bootstrap.min.js"></script>

            <script src="../js/custom.js"></script>   

            <script src="../js/services.js"></script>
    </body>

</html>
