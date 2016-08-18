<?php
    include ("../admin/db/conexion.php");
    // connect_base_de_datos();
    session_start();

    $namefunction = $_POST['namefunction'];
    switch($namefunction){

      case 'cambio_tamano':
        cambio_tamano();
        break;
      case 'cambio_cantidad':
        cambio_cantidad();
        break;
      case 'agregar_producto':
        agregar_producto();
        break;
      case 'actualizar_carrito':
        actualizar_carrito();
        break;
      case 'eliminar_item_cart':
        eliminar_item_cart();
        break;
      case 'incrementar_item_cart':
        incrementar_item_cart();
        break;
      case 'disminuir_item_cart':
        disminuir_item_cart();
        break;
      case 'actualizar_carrito_confirmar':
          actualizar_carrito_confirmar($_POST['idProduct'],$_POST['quantity']);
          break;
      case 'verificar_fecha':
          verificar_fecha();
          break;
      case 'colonia_change':
          colonia_change();
          break;
      case 'municipio_change':
          municipio_change();
          break;
      case 'cpostal_change':
          cpostal_change();
          break;
      case 'calcular_costo_final':
          calcular_costo_final();
          break;
      case 'registrar_datos_pago':
          registrar_datos_pago();
          break;
      case 'registrar_factura':
          registrar_factura();
          break;
      case 'verify_day_end':
          verify_day_end();
          break;
      case 'verify_max_stock':
          verify_max_stock($_POST['idProduct'], $_POST['quantity']);
          break;
      case 'verify_stocks':
          verify_stocks($_POST['idProduct'], $_POST['quantity']);
          break;
    }

    function verify_max_stock($idProduct, $cantidad){

      if(isset($_SESSION['carrito'])){

        $total_cantidad_aux = 0;
        $resultvar = 1;
        $query = "SELECT Stock FROM Productos WHERE IdProducto =".$idProduct;
        $result = mysql_query($query,Conectar::con()) or die(mysql_error());
        $line = mysql_fetch_array($result);
        if(mysql_num_rows($result)>0){
          $stock_max = $line['Stock'];
            foreach ($_SESSION['carrito'] as $key => $value) {
              if($value['id_producto'] == $idProduct){
                $cantidad_cart = $value['cantidad'];
                $total_cantidad_aux = $cantidad_cart + $cantidad;
                $query = "SELECT Stock FROM Productos WHERE IdProducto =".$value['id_producto'];
                $result = mysql_query($query,Conectar::con()) or die(mysql_error());
                $line = mysql_fetch_array($result);
                $stock_max = $line['Stock'];

                if($stock_max<$total_cantidad_aux)
                  $resultvar =  0;
                else
                  $resultvar =  1;
                break;
              }
            }
        }
        echo $resultvar;

      } else {

        $query = "SELECT Stock FROM Productos WHERE IdProducto =".$idProduct;
        $result = mysql_query($query,Conectar::con()) or die(mysql_error());
        $line = mysql_fetch_array($result);
        if(mysql_num_rows($result)>0){
          $stock_max = $line['Stock'];
          if($stock_max<$cantidad)
            echo 0;
          else
            echo 1;
        }

      }
    }

    function verify_stocks($idProduct, $cantidad){

      $total_cantidad_aux = 0;
      $resultvar = 1;
      $query = "SELECT Stock FROM Productos WHERE IdProducto =".$idProduct;
      $result = mysql_query($query,Conectar::con()) or die(mysql_error());
      $line = mysql_fetch_array($result);
      if(mysql_num_rows($result)>0){
        $stock_max = $line['Stock'];
        foreach ($_SESSION['carrito'] as $key => $value) {
          if($value['id_producto'] == $idProduct){
            // $cantidad_cart = $value['cantidad'];
            // $total_cantidad_aux = $cantidad + 1;
            $query = "SELECT Stock FROM Productos WHERE IdProducto =".$value['id_producto'];
            $result = mysql_query($query,Conectar::con()) or die(mysql_error());
            $line = mysql_fetch_array($result);
            $stock_max = $line['Stock'];
            if($stock_max<$cantidad)
              $resultvar =  0;
            else
              $resultvar =  1;
            break;
          }
        }
      }
      echo $resultvar;

    }

    function cambio_tamano(){

      $id_tamano = $_POST['id_tamano'];
      $id_producto = $_POST['id_producto'];

      $query = "SELECT precio FROM detalle_tamano WHERE id_tamano_producto = ".$id_tamano." AND id_producto = ".$id_producto;
      $result = mysql_query($query) or die(mysql_error());
      $line = mysql_fetch_array($result);

      echo $line['precio'];

    }

    function cambio_cantidad(){

      $id_tamano = $_POST['id_tamano'];
      $id_producto = $_POST['id_producto'];

      if($id_tamano!=0){
        $query = "SELECT precio FROM detalle_tamano WHERE id_tamano_producto = ".$id_tamano." AND id_producto = ".$id_producto;
        $result = mysql_query($query) or die(mysql_error());
        $line = mysql_fetch_array($result);
        echo $line['precio'];
      }else{
        $query = "SELECT precio_producto FROM producto WHERE id_producto = ".$id_producto;
        $result = mysql_query($query) or die(mysql_error());
        $line = mysql_fetch_array($result);
        echo $line['precio_producto'];
      }

    }

    //Agregar productos al carrito.
    function agregar_producto(){

      if(isset($_SESSION['carrito'])){

        $id_producto = $_POST['idProduct'];
        $precio = $_POST['notprice'];
        $cantidad = $_POST['quantity'];
        $sub_total = $precio*$cantidad;

        $arreglo_carrito = $_SESSION['carrito'];
        $find = false;

        foreach ($arreglo_carrito as $key => $value) {
          if($arreglo_carrito[$key]['id_producto'] == $id_producto)
            $find = true; 
        }

        if ($find == true) {
          for ($i=0; $i < count($arreglo_carrito); $i++) { 
            if ($id_producto == $arreglo_carrito[$i]['id_producto']) {
              if ($cantidad == 1) {

                $arreglo_carrito[$i]['cantidad'] = $arreglo_carrito[$i]['cantidad'] + 1;
                $arreglo_carrito[$i]['sub_total'] = $arreglo_carrito[$i]['cantidad'] * $arreglo_carrito[$i]['precio'];

              } else if ($cantidad > 1) {

                $arreglo_carrito[$i]['cantidad'] = $arreglo_carrito[$i]['cantidad'] + $cantidad;
                $arreglo_carrito[$i]['sub_total'] = $arreglo_carrito[$i]['cantidad'] * $arreglo_carrito[$i]['precio'];

              }
            }
          }

          $_SESSION['carrito'] = $arreglo_carrito;

        } else {

          $query = "SELECT * FROM Productos WHERE IdProducto =".$id_producto;
          $result = mysql_query($query,Conectar::con()) or die(mysql_error());
          $line = mysql_fetch_array($result);

          $images = explode(',', $line['Image']);
          $arreglo_descr_producto = array(
            'id_producto' => $id_producto,
            'nombre_producto' => $line['NombreProd'],
            'descripcion_producto' => $line['Descripcion'],
            'foto_producto' => $images[0],
            'id_categoria' => $line['Categorias_IdCategoria'],
            'id_subcategoria' => $line['Subcategoria_IdSubcategoria'],
            'id_marca' => $line['Marcas_IdMarca'],
            'cantidad' => $cantidad,
            'precio_lista' => $line['PrecioLista'],
            'precio' => $precio,
            'sub_total' => $sub_total,
            'costo_envio' => $line['CostoEnvio']
          );

          array_push($arreglo_carrito, $arreglo_descr_producto);
          $_SESSION['carrito'] = $arreglo_carrito;

        }

          print_r($_SESSION['carrito']);

      } else {
        $id_producto = $_POST['idProduct'];
        $precio = $_POST['notprice'];
        $cantidad = $_POST['quantity'];
        $sub_total = $precio*$cantidad;

          $query = "SELECT * FROM Productos WHERE IdProducto =".$id_producto;
          $result = mysql_query($query,Conectar::con()) or die(mysql_error());
          $line = mysql_fetch_array($result);

          $images = explode(',', $line['Image']);
          $arreglo_descr_producto[] = array(
            'id_producto' => $id_producto,
            'nombre_producto' => $line['NombreProd'],
            'descripcion_producto' => $line['Descripcion'],
            'foto_producto' => $images[0],
            'id_categoria' => $line['Categorias_IdCategoria'],
            'id_subcategoria' => $line['Subcategoria_IdSubcategoria'],
            'id_marca' => $line['Marcas_IdMarca'],
            'cantidad' => $cantidad,
            'precio_lista' => $line['PrecioLista'],
            'precio' => $precio,
            'sub_total' => $sub_total,
            'costo_envio' => $line['CostoEnvio']
          );

          $_SESSION['carrito'] = $arreglo_descr_producto;

      }

    }

    //Eliminar producto del carrito.
    function eliminar_item_cart(){

      $id_item_pos_cart = $_POST['id_item_pos_cart'];
      $arreglo_carrito = $_SESSION['carrito'];

      foreach ($arreglo_carrito as $key => $value) {
        if($arreglo_carrito[$key]['indetificar_pos'] == $id_item_pos_cart){
          unset($arreglo_carrito[$key]);
        }
      }

      $_SESSION['carrito'] = $arreglo_carrito;

      if(count($_SESSION['carrito']) == 0){
        unset($_SESSION['carrito']);
      }

    }

    //Disminuir cantidad de un articulo.
    function disminuir_item_cart(){
      if (isset($_SESSION['carrito'])) {
        $idItemCart = $_POST['idItemCart'];
        $arreglo_carrito = $_SESSION['carrito'];

        $query = "SELECT Stock FROM Productos WHERE IdProducto =".$idItemCart;
        $result = mysql_query($query,Conectar::con()) or die(mysql_error());
        $line = mysql_fetch_array($result);
        $stock_max = $line['Stock'];

        foreach ($arreglo_carrito as $key => $value) {
          if($arreglo_carrito[$key]['id_producto'] == $idItemCart){

            $total_cantidad = $stock_max + 1;
            $query1 = "UPDATE Productos SET Stock = '".$total_cantidad."' WHERE IdProducto = '".$idItemCart."'";
            $result1 = mysql_query($query1,Conectar::con()) or die(mysql_error());

            $arreglo_carrito[$key]['cantidad'] = $arreglo_carrito[$key]['cantidad'] - 1;
            $arreglo_carrito[$key]['sub_total'] = $arreglo_carrito[$key]['cantidad'] * $arreglo_carrito[$key]['precio'];

            if($arreglo_carrito[$key]['cantidad']==0){
              unset($arreglo_carrito[$key]);
            }
          }
        }

        $_SESSION['carrito'] = $arreglo_carrito;

        if(count($_SESSION['carrito']) == 0){
          unset($_SESSION['carrito']);
        }
      }
    }

    //Aumentar cantidad de un articulo.
    function incrementar_item_cart(){

      $idItemCart = $_POST['idItemCart'];
      $arreglo_carrito = $_SESSION['carrito'];

      /* Se añadio para modificar el stock en la base de datos */
      // $query = "SELECT Stock FROM Productos WHERE IdProducto =".$idItemCart;
      // $result = mysql_query($query,Conectar::con()) or die(mysql_error());
      // $line = mysql_fetch_array($result);
      // $stock_max = $line['Stock'];
      /*-------------------------------------------*/

      foreach ($arreglo_carrito as $key => $value) {
        if($arreglo_carrito[$key]['id_producto'] == $idItemCart){

          $arreglo_carrito[$key]['cantidad'] = $arreglo_carrito[$key]['cantidad'] + 1;
          $arreglo_carrito[$key]['sub_total'] = $arreglo_carrito[$key]['cantidad'] * $arreglo_carrito[$key]['precio'];

          /* Se añadio para modificar el stock en la base de datos */
          // $total_cantidad = $stock_max - 1;
          // $query1 = "UPDATE Productos SET Stock = '".$total_cantidad."' WHERE IdProducto = '".$idItemCart."'";
          // $result1 = mysql_query($query1,Conectar::con()) or die(mysql_error());
          /*-------------------------------------------*/

          if($arreglo_carrito[$key]['cantidad']==0){
            unset($arreglo_carrito[$key]);
          }
        }
      }

      $_SESSION['carrito'] = $arreglo_carrito;

      if(count($_SESSION['carrito']) == 0){
        unset($_SESSION['carrito']);
      }

    }

    //En esta parte, actualizaremos la parte del carrito frontend, mostrando cada cambio al instante.
    function actualizar_carrito(){

        if(isset($_SESSION['carrito'])){
          $total = 0;
          for ($i=0; $i < count($_SESSION['carrito']); $i++) { 
            $total = $total + $_SESSION['carrito'][$i]["sub_total"];
          }

          echo '
                  <div class="act_cont">
                    <div class="total_buy">
                      <span>TOTAL</span>
                    </div>
                        <span class="price_total">$'.number_format($total,2,".",",").'</span>
                        <a href="carrito.php"> <span class="gotocart">IR AL CARRITO</span> </a>
                        <span class="alertaCapMax"></span>
                    </div>
            ';

          $_SESSION['total_carrito'] = $total;
          $_SESSION['carrito'] = $_SESSION['carrito'];

          // foreach ($_SESSION['carrito'] as $key => $value) {
          //   $total = $total + $_SESSION['carrito'][$key]["sub_total"];
          //   echo '$'.number_format($_SESSION['carrito'][$key]["sub_total"],2,".",",").'';
          // }


      //     $total = 0;
      //     $data = $_SESSION['carrito'];

      //     foreach ($data as $i => $value) {
      //           $total = $total + $data[$i]["sub_total"];

      //           $qaux = "SELECT Stock FROM Productos WHERE IdProducto = ".$data[$i]["id_producto"];
      //           $raux = mysql_query($qaux,Conectar::con()) or die(mysql_error());
      //           $laux = mysql_fetch_array($raux);
      //           $cantidadMax = $laux['Stock'];

      //           echo '
      //               <div class="cont_user">
      //                 <div class="cant_most_less">

      //                   <input type="text" class="input_cant" value="'.$data[$i]["cantidad"].'" name=""  data-cantidad="'.$data[$i]["cantidad"].'" readonly>
      //                   <span class="less_item_cart" name="'.$data[$i]["nombre_producto"].'"><img src="../img/store_actions-03.png"></span>
      //                   <span class="more_item_cart" name="'.$data[$i]["nombre_producto"].'" data-id-product="'.$data[$i]["id_producto"].'" data-name-product="'.$data[$i]["nombre_producto"].'" data-cant-maxima="'.$cantidadMax.'" ><img src="../img/store_actions-01.png"></span>
      //                 </div>

      //                 <span class="left_side delete_item_cart" name="'.$data[$i]["nombre_producto"].'"><img src="../img/close_img.png"></span>

      //                 <div class="info_buy">
      //                   <div>
      //                     <span>'.$data[$i]["nombre_producto"].'</span>
      //           ';

      //           echo '
      //                       </div>
      //                       <span>$'.number_format($data[$i]["sub_total"],2,".",",").'</span>
      //                   </div>
      //               </div>
      //           ';
      //       }

      //       echo '
      //             <div class="act_cont">
      //               <div class="total_buy">
      //                 <span>TOTAL</span>
      //               </div>
      //                   <span class="price_total">$'.number_format($total,2,".",",").'</span>
      //                   <a href="carrito.php"> <span class="gotocart">IR AL CARRITO</span> </a>
      //                   <span class="alertaCapMax"></span>
      //               </div>
      //       ';

      //       $_SESSION['total_carrito'] = $total;

        }else{

          echo "No hay sesion actualizar_carrito";
          echo '
            <div class="g_cart_cont"><br>
              <div class="price_total">
                <span>NO HAZ AGREGADO NINGÚN PRODUCTO.</span>
              </div><br>
              <div class="total_buy">
                <span>TOTAL</span>
              </div>
              <span class="price_total">$00.00</span>
              </div>
              <span class="alertaCapMax"></span>
          ';
          
        }

    }

    //Actualizamos el carrito de la session confirma
    function actualizar_carrito_confirmar($idProduct,$quantity){

        if(isset($_SESSION['carrito'])){

          $query = "SELECT Stock FROM Productos WHERE IdProducto =".$idProduct;
          $result = mysql_query($query,Conectar::con()) or die(mysql_error());
          $line = mysql_fetch_array($result);

          if(mysql_num_rows($result)>0){
            // $stock_max = $line['Stock'];
            foreach ($_SESSION['carrito'] as $key => $value) {

              if($value['id_producto'] == $idProduct){

                $query = "SELECT Stock FROM Productos WHERE IdProducto =".$value['id_producto'];
                $result = mysql_query($query,Conectar::con()) or die(mysql_error());
                $line = mysql_fetch_array($result);
                $stock_max = $line['Stock'];
                $cantidad_cart = $value['cantidad'];

                if ($quantity == 1) {

                  $total_cantidad = $stock_max - 1;
                  $query1 = "UPDATE Productos SET Stock = '".$total_cantidad."' WHERE IdProducto = '".$value['id_producto']."'";
                  $result1 = mysql_query($query1,Conectar::con()) or die(mysql_error());

                } else if($quantity > 1) {

                  $total_cantidad = $stock_max - $cantidad_cart;
                  $query1 = "UPDATE Productos SET Stock = '".$total_cantidad."' WHERE IdProducto = '".$value['id_producto']."'";
                  $result1 = mysql_query($query1,Conectar::con()) or die(mysql_error());

                }

              }

            }
            $_SESSION['carrito'] = $_SESSION['carrito'];

          }

        }

        //     $total = 0;
        //     $data = $_SESSION['carrito'];

        //     foreach ($data as $key => $value) {

        //         $total = $total + $data[$key]['sub_total'];

        //         echo '
        //             <div class="store_article">

        //                 <div class="img_article">
        //                     <img src="../img/productos/'.$data[$key]["foto_producto"].'">
        //                 </div>

        //                 <div class="info_article">
        //                     <div class="shop_title_shop_2">
        //                         <span>'.$data[$key]["nombre_producto"].'</span>
        //         ';

        //         if($data[$key]["id_sabor_producto"]!=0){
        //             $result = mysql_query("SELECT nombre_sabor_producto FROM sabor_producto WHERE id_sabor_producto =".$data[$key]['id_sabor_producto']) or die(mysql_error());
        //             $line = mysql_fetch_array($result);
        //             echo '      <span>Sabor: '.$line["nombre_sabor_producto"].'</span>';
        //         }


        //         if($data[$key]["id_tamano_producto"]!=0){

        //             $query_tam = "SELECT nombre FROM  presentacion_tamano INNER JOIN detalle_tamano ON presentacion_tamano.id_presentacion = detalle_tamano.id_presentacion
        //             WHERE  detalle_tamano.id_producto = ".$data[$key]['id_producto']." AND  detalle_tamano.id_tamano_producto = ".$data[$key]['id_tamano_producto'];
        //             $result_tam_name = mysql_query($query_tam) or die(mysql_errno());
        //             $line_tam = mysql_fetch_array($result_tam_name);


        //             $result = mysql_query("SELECT cantidad FROM tamano_producto WHERE id_tamano_producto =".$data[$key]['id_tamano_producto']) or die(mysql_error());
        //             $line = mysql_fetch_array($result);
        //             echo '      <span>Tamaño: '.$line["cantidad"].' '.$line_tam["nombre"].'</span>';
        //         }

        //             $qaux = "SELECT horas_produccion FROM producto WHERE id_producto = ".$data[$key]["id_producto"];
        //             $raux = mysql_query($qaux) or die(mysql_error());
        //             $laux = mysql_fetch_array($raux);
        //             $cantidadMax = $laux['horas_produccion'];

        //         echo '
        //                         <span class="precio">$'.number_format($data[$key]["sub_total"],2,".",",").'</span>
        //                     </div>

        //                     <div class="descr_info">
        //                         <p>'.$data[$key]["descripcion_producto"].'</p>
        //                         <div class="cant_buy">
        //                             <div class="cant_most_less">
        //                                 <span class="left_side left_side_2 delete_item_cart" name="'.$data[$key]["indetificar_pos"].'"><img src="../img/close_img.png"></span>
        //                                 <input type="text" class="input_cant" value="'.$data[$key]["cantidad"].'"  data-cantidad="'.$data[$key]["cantidad"].'" readonly>
        //                                 <span class="less_item_cart" name="'.$data[$key]["indetificar_pos"].'"><img src="../img/store_actions-03.png"></span>
        //                                 <span class="more_item_cart" name="'.$data[$key]["indetificar_pos"].'" data-id-product="'.$data[$key]["id_producto"].'" data-name-product="'.$data[$key]["nombre_producto"].'" data-cant-maxima="'.$cantidadMax.'"  ><img src="../img/store_actions-01.png"></span>
        //                             </div>
        //                         </div>
        //                     </div>

        //                 </div>

        //             </div>
        //         ';

        //     }
        //     echo '

        //             <div class="total_buy">
        //                 <span>TOTAL</span>
        //             </div>

        //             <span class="price_total">$'.number_format($total,2,".",",").'</span>

        //             <a href="checkout.php"><span class="gotocart ">COMPRAR</span></a>
        //             <a href="ordena.php"><span class="gotocart space_cart">REGRESAR</span></a>

        //     ';

        //     $_SESSION['total_carrito'] = $total;

        // }else{

        //     echo '
        //             <div class="g_cart_cont"><br>
        //                 <div class="price_total price_total_2">
        //                     <span>NO HAZ AGREGADO NINGÚN PRODUCTO.</span>
        //                 </div><br>
        //                 <div class="total_buy">
        //                     <span>TOTAL</span>
        //                 </div>

        //                 <span class="price_total">$00.00</span>

        //                 <a href="ordena.php"><span class="gotocart space_cart">REGRESAR</span></a>
        //                 <span class="alertaCapMax"></span>

        //             </div>
        //     ';

        // }

    }

    function verify_day_end(){
      $dia_final = $_POST['dia_final'];
      $mes_final_val = $_POST['mes_final_val']+1;
      $anio_final = $_POST['anio_final'];
      $time = strtotime($mes_final_val.'/'.$dia_final.'/'.$anio_final);
      $dateStringCompare = date('Y-m-d',$time);
      $counter = 0;
      $dayAccept = false;
      while(!$dayAccept){
        $change = false;
        foreach ($_SESSION['carrito'] as $key => $value) {
          $query = "SELECT * FROM block_date_product WHERE dateBlock = '$dateStringCompare' AND idProduct = ".$value["id_producto"];
          $result = mysql_query($query) or die(mysql_error());
          if(mysql_num_rows($result)>0){
            $change = true;
            $counter++;
            $dateIncrement = strtotime("+1 day", strtotime($dateStringCompare));
            $dateStringCompare = date('Y-m-d',$dateIncrement);
          }else{
            $q1 = "SELECT sum(detalle_pedido.cantidad) AS sumatoria FROM pedido INNER JOIN detalle_pedido
                   ON pedido.id_pedido = detalle_pedido.id_pedido
                   WHERE detalle_pedido.id_producto = ".$value["id_producto"]."
                   AND pedido.fecha_entrega = '".$dateStringCompare."'
                   AND pedido.status = 1";
            $r1 = mysql_query($q1) or die(mysql_error());
            $l1 = mysql_fetch_array($r1);
            $cant = $l1['sumatoria'] + $value["cantidad"];
            $q2 = "SELECT horas_produccion FROM producto WHERE id_producto = ".$value["id_producto"];
            $r2 = mysql_query($q2) or die(mysql_error());
            $l2 = mysql_fetch_array($r2);
            $stock = $l2['horas_produccion'];
            if($cant>$stock){
              $change = true;
              $counter++;
              $dateIncrement = strtotime("+1 day", strtotime($dateStringCompare));
              $dateStringCompare = date('Y-m-d',$dateIncrement);
            }
          }
        }
        if($change){
          $dayAccept = false;
        }else{
           $dayAccept = true;
        }
      }
      $data = array(
        'counter' => $counter,
        'fecha' => $dateStringCompare
      );
      echo json_encode($data);
    }

    //En esta funcion vamos a verificar la fecha y solamente daremos los dias que estan permitidos laborar.
    function verificar_fecha(){
        $select_month = $_POST['select_month'];
        $select_year = $_POST['select_year'];
        $query = "SELECT * FROM close_date WHERE month = ".$select_month;
        $result = mysql_query($query) or die(mysql_error());
        $array_no_days[] = "";
        while($line = mysql_fetch_array($result)){
            $close_date = array(
                'day' => $line['day'],
                'year' => $line['year'],
                'month' => $line['month']
            );
            array_push($array_no_days,$close_date);
        }

        //SE GENERO ESTO PARA HACER PARCHE.
        // $dia_final = $_POST['dia_final'];
        // $mes_final_val = $_POST['mes_final_val'];
        // $anio_final = $_POST['anio_final'];
        // foreach ($_SESSION['carrito'] as $key => $value) {
        //   $query ="SELECT * FROM pedido INNER JOIN  detalle_pedido
        //   ON pedido.id_pedido = detalle_pedido.id_pedido
        //   WHERE pedido.status = 1";
        //   $result = mysql_query($query) or die(mysql_error());
        //   $line = mysql_fetch_array($result);
        //   $id_producto = $line['id_producto'];
        //
        //   //Se ocupa base de datos blockDateProduct
        //   $query = "SELECT * FROM blockDateProduct WHERE dateBlock = '".$anio_final."-".$mes_final_val."-".$dia_final."AND $idProduct = $id_producto";
        //   $result = mysql_query($query) or die(mysql_error());
        //   if(mysql_num_rows($result)>0){
        //     $close_date = array(
        //         'day' => $dia_final,
        //         'year' => $anio_final,
        //         'month' => $mes_final_val
        //     );
        //     array_push($array_no_days,$close_date);
        //   }
        // }

        //Aqui se agrega al array $array_no_days los dias bloqueados que se superaron.
        switch ($select_month) {
            case 1: case 3: case 5: case 7: case 8: case 10: case 12:
            echo '<select class="comprar_select select_day" name="select_day">';
                for($i=1; $i<=31; $i++ ){
                    $found = 0;
                    foreach ($array_no_days as $key => $value) {
                        if($i==$array_no_days[$key]['day'] && $select_year == $array_no_days[$key]['year'])
                            $found=1;
                    }

                    if($found==0){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }else{
                        echo '<option value="'.$i.'" name="bloqueado" >'.$i.'</option>';
                    }

                }
            echo "</select>";
            break;
            case 2:
            echo '<select class="comprar_select select_day" name="select_day">';
                for($i=1; $i<=28; $i++ ){
                    $found = 0;
                    foreach ($array_no_days as $key => $value) {
                        if($i==$array_no_days[$key]['day'] && $select_year == $array_no_days[$key]['year'])
                            $found=1;
                    }

                    if($found==0){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }else{
                        echo '<option value="'.$i.'" name="bloqueado" >'.$i.'</option>';
                    }

                }
            echo "</select>";
            break;
            case 4: case 6: case 9: case 11:
            echo '<select class="comprar_select select_day" name="select_day">';
                for($i=1; $i<=30; $i++ ){
                    $found = 0;
                    foreach ($array_no_days as $key => $value) {
                        if($i==$array_no_days[$key]['day'] && $select_year == $array_no_days[$key]['year'])
                            $found=1;
                    }

                    if($found==0){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }else{
                        echo '<option value="'.$i.'" name="bloqueado" >'.$i.'</option>';
                    }

                }
            echo "</select>";
            break;
        }
        echo '
        <select class="comprar_select select_month" name="select_month">
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>
        <select class="comprar_select select_year" name="select_year">
            <option name="1" value="2016">2016</option>
            <option name="2" value="2017">2017</option>
            <option name="3" value="2018">2018</option>
        </select>
        ';
    }

    //funcion que verifica la colonia para dar nuevos municipios.
    function municipio_change(){

        $id_municipio = $_POST['id_municipio'];

        $_SESSION['cargo_envio'] = 0;

        $query = "SELECT * FROM colonia_acep WHERE id_municipio = ".$id_municipio." ORDER BY nombre_colonia";

        $result = mysql_query($query) or die(mysql_error());
        echo '<option name="0" value="" selected disabled>Selecciona tu Colonia: </option>';
        while($line = mysql_fetch_array($result)){
            echo '<option name="'.$line["id_colonia"].'" value="'.$line["id_colonia"].'">'.$line["nombre_colonia"].'</option>';
        }

    }

    //verifica los municipios para dar los codigos postales
    function colonia_change(){

        $id_colonia = $_POST['id_colonia'];

        $_SESSION['cargo_envio'] = 0;

        $query = "SELECT * FROM direcciones_aceptados WHERE id_colonia = ".$id_colonia." ORDER BY codigo_postal";
        $result = mysql_query($query) or die(mysql_error());
        echo '<option name="0" value="" data-costo-type="0" selected disabled>Selecciona tu Código Postal: </option>';
        while($line = mysql_fetch_array($result)){
            echo '<option name="'.$line["codigo_postal"].'" value="'.$line["codigo_postal"].'" data-costo-type="'.$line["costo_envio"].'">'.$line["codigo_postal"].'</option>';
        }

    }

    function cpostal_change(){

        $costo_envio = $_POST['costo_envio'];
        $total_carrito = $_SESSION['total_carrito'] + $costo_envio;

        $_SESSION['cargo_envio'] = $costo_envio;

        $response = array(
            'mensaje' => 'Tu pedido tiene un costo de envio de: $'.number_format($costo_envio,2,".",","),
            'total_carrito' => $total_carrito
        );

        echo json_encode($response);

    }

    function calcular_costo_final(){

        $total_carrito_mas_envio = $_SESSION['cargo_envio'] + $_SESSION['total_carrito'];
        $total_carrito_mas_envio_format = number_format($total_carrito_mas_envio,2,".",",");
        $_SESSION['total_carrito_mas_envio'] = $total_carrito_mas_envio;

        $response = array(
            'total_carrito_mas_envio' => $total_carrito_mas_envio,
            'total_carrito_mas_envio_format' => $total_carrito_mas_envio_format
        );

        echo json_encode($response);

    }

    function registrar_datos_pago(){
          
      parse_str($_POST['action'],$formData);

      print_r($formData);

        // //Datos para la tabla pedido.
        // $orden_pedido = "NULL";
        // $nombre_cliente = $_POST['name'];
        // $apellidos_cliente = $_POST['lastname'];
        // $email_cliente = $_POST['email'];
        // $telefono_cliente = $_POST['phone'];
        // $date_today = date('Y-m-d');
        // $fecha_pedido = $date_today;
        // $date_user = date($_POST["select_year"].'-'.$_POST["select_month"].'-'.$_POST["select_day"]);
        // $fecha_entrega = $date_user;
        // $total_pedido = $_SESSION['total_carrito_mas_envio'];
        // $horario_entrega = $_POST["select_horario"];
        // $status = false;

        // $query = "INSERT INTO pedido (orden_pedido, nombre_cliente, apellidos_cliente, email_cliente, telefono_cliente, fecha_pedido, horario_entrega, fecha_entrega, total_pedido, status)
        //           VALUES ('$orden_pedido', '$nombre_cliente', '$apellidos_cliente', '$email_cliente', '$telefono_cliente', '$fecha_pedido', '$horario_entrega','$fecha_entrega', '$total_pedido', '$status') ";
        // $result = mysql_query($query) or die(mysql_error());

        // $id_pedido = mysql_insert_id();
        // $orden_pedido = "PAYMGT".$id_pedido.date("Y").date("m").date("d");

        // $query = "UPDATE pedido SET orden_pedido = '$orden_pedido' WHERE id_pedido = $id_pedido";
        // $result = mysql_query($query) or die(mysql_error());

        // //Datos para la tabla detalle pedido.
        // $data_cart = $_SESSION['carrito'];
        // foreach ($data_cart as $key => $value) {
        //     $id_producto = $data_cart[$key]['id_producto'];
        //     $id_sabor_producto = $data_cart[$key]['id_sabor_producto'];
        //     $id_tamano_producto = $data_cart[$key]['id_tamano_producto'];
        //     $cantidad = $data_cart[$key]['cantidad'];

        //     $query = "INSERT INTO detalle_pedido (id_pedido, id_producto,  id_sabor_producto, id_tamano_producto, cantidad)
        //               VALUES ($id_pedido, $id_producto, $id_sabor_producto, $id_tamano_producto, $cantidad)";
        //     $result = mysql_query($query) or die(mysql_error());
        // }

        // //Datos de direccion, para la tabla datos_entrega.
        // if(isset($_POST['select_municipio']) && isset($_POST['select_colonia']) && isset($_POST['select_cpostal'])){

        //     $select_municipio = $_POST['select_municipio'];
        //     $select_colonia  = $_POST['select_colonia'];
        //     $select_cpostal = $_POST['select_cpostal'];
        //     $direccion_complete = $_POST['direccion_complete'];
        //     $num_direccion = $_POST['num_direccion'];
        //     $streets = $_POST['streets'];

        //     $query = "SELECT id_direccion
        //         FROM direcciones_aceptados
        //         WHERE id_municipio = '$select_municipio'
        //         AND id_colonia = '$select_colonia'
        //         AND codigo_postal = '$select_cpostal' ";
        //     $result = mysql_query($query) or die(mysql_error());
        //     $line = mysql_fetch_array($result);
        //     $id_direccion = $line['id_direccion'];

        //     $query = "INSERT INTO datos_entrega (id_direccion, id_pedido, direccion_complete, num_direccion, streets) VALUES ($id_direccion, $id_pedido, '$direccion_complete', '$num_direccion', '$streets')";
        //     $result = mysql_query($query) or die(mysql_error());

        // }

        // $response_2 = array(
        //     'orden_pedido' => $orden_pedido,
        //     'amount' => $_SESSION['total_carrito'],
        //     'shipping' => $_SESSION['cargo_envio']
        // );

        // echo json_encode($response_2);

    }

    //funcion para registrar la factura
    function registrar_factura(){

        $num_pedido = $_POST['num_pedido'];
        $name = $_POST['name'];
        $rfc = $_POST['rfc'];
        $r_social = $_POST['r_social'];
        $address_fiscal = $_POST['address_fiscal'];
        $num_ext = $_POST['num_ext'];
        $num_int = $_POST['num_int'];
        $estado = $_POST['estado'];
        $colonia_fact = $_POST['colonia_fact'];
        $ciu_or_mun = $_POST['ciu_or_mun'];
        $cp = $_POST['cp'];
        $email = $_POST['email'];

        $query = "SELECT id_pedido FROM pedido WHERE orden_pedido = '".$num_pedido."'";
        $result = mysql_query($query) or die(mysql_error());
        $line = mysql_fetch_array($result);

        $id_pedido = $line['id_pedido'];

        $query = "INSERT INTO datos_facturacion (nombre_contacto, email_contacto, rfc, razon_social, domicilio_fiscal, no_ext, no_int, estado, ciudad_municipio, colonia, cp, orden_pedido, id_pedido)
                  VALUES ('$name', '$email', '$rfc', '$r_social', '$address_fiscal', '$num_ext', '$num_int', '$estado', '$ciu_or_mun', '$colonia_fact', '$cp', '$num_pedido', '$id_pedido') ";
        $result = mysql_query($query) or die(mysql_error());

    }

?>
