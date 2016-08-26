<?php 
        require_once("../admin/db/conexion.php");

        

    // Primera comprobación. Cerraremos este if más adelante
    if($_POST){
        // Obtenemos los datos en formato variable1=valor1&variable2=valor2&...
        $raw_post_data = file_get_contents('php://input');

        // Los separamos en un array
        $raw_post_array = explode('&',$raw_post_data);

        // Separamos cada uno en un array de variable y valor
        $myPost = array();
        foreach($raw_post_array as $keyval){
            $keyval = explode("=",$keyval);
            if(count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }

        // Nuestro string debe comenzar con cmd=_notify-validate
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')){
            $get_magic_quotes_exists = true;
        }
        foreach($myPost as $key => $value){
            // Cada valor se trata con urlencode para poder pasarlo por GET
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value)); 
            } else {
                $value = urlencode($value);
            }

            //Añadimos cada variable y cada valor
            $req .= "&$key=$value";
        }

            $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');   // Esta URL debe variar dependiendo si usamos SandBox o no. Si lo usamos, se queda así.
        //$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');         // Si no usamos SandBox, debemos usar esta otra linea en su lugar.
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

        if( !($res = curl_exec($ch)) ) {
            // Ooops, error. Deberiamos guardarlo en algún log o base de datos para examinarlo después.
            curl_close($ch);
            exit;
        }
        curl_close($ch);
                if (strcmp ($res, "VERIFIED") == 0) {
            /**
             * A partir de aqui, deberiamos hacer otras comprobaciones rutinarias antes de continuar. Son opcionales, pero recomiendo al menos las dos primeras. Por ejemplo:
             * 
             * * Comprobar que $_POST["payment_status"] tenga el valor "Completed", que nos confirma el pago como completado.
             * * Comprobar que no hemos tratado antes la misma id de transacción (txd_id)
             * * Comprobar que el email al que va dirigido el pago sea nuestro email principal de PayPal
             * * Comprobar que la cantidad y la divisa son correctas
             */

            // Después de las comprobaciones, toca el procesamiento de los datos.

            /**
             * En este punto tratamos la información.
             * Podemos hacer con ella muchas cosas:
             * 
             * * Guardarla en una base de datos.
             * * Guardar cada linea del pedido en una linea diferente en la base de datos.
             * * Guardar un log.
             * * Restar las cantidades de los artículos del stock.
             * * Enviar un mensaje de confirmcaión al cliente.
             * * Enviar un mensaje al encargado de pedidos para que lo prepare.
             * * Comprobar mediante complejas operaciones matemáticas si el cliente es el número un millon y notificarle de que ha ganado dos noches de hotel en Torrevieja.
             * * ¡Imaginación!
             */

            require_once("../admin/db/conexion.php");

            // $id_pedido = $_GET['num'];
            // $query = "SELECT * FROM Pedidos p INNER JOIN Productos_has_Pedidos pp ON pp.Pedidos_IdPedido = p.IdPedido WHERE p.IdPedido = '".$id_pedido."'";
            // $result = mysql_query($query,Conectar::con()) or die(mysql_error());

            // $query1 = "UPDATE Pedidos SET Status = 1 WHERE IdPedido = '$id_pedido'";
            // $result1 = mysql_query($query1,Conectar::con()) or die(mysql_error());

            // while ($line = mysql_fetch_array($result)) {

            //     $query2 = "SELECT Stock FROM Productos WHERE IdProducto = '".$line['Productos_IdProducto']."'";
            //     $result2 = mysql_query($query2,Conectar::con()) or die(mysql_error());
            //     $row = mysql_fetch_array($result2);
            //     $stocks = $row['Stock'];
            //     $total_stocks = $stocks - $line['Cantidad'];
            //     $query3 = "UPDATE Productos SET Stock = '".$total_stocks."' WHERE IdProducto = '".$line['Productos_IdProducto']."'";
            //     $result3 = mysql_query($query3,Conectar::con()) or die(mysql_error());
            // }

            /* Email Failbox*/
            $id_pedido = $_GET['num'];
            $query4 = "SELECT * FROM Pedidos p INNER JOIN Usuarios u ON u.IdUsuario = p.Usuarios_IdUsuario WHERE p.IdPedido = '".$id_pedido."'";
            $result4 = mysql_query($query4,Conectar::con()) or die (mysql_error());
            $field = mysql_fetch_array($result4);


            $nombre_cliente = $field['Nombre'];
            $apellidos_cliente = $field['Apellido'];
            $email_cliente = $field['Email'];
            // $telefono_cliente = $field['Email'];
            $fecha_pedido = $field['FechaPedido'];
            // $fecha_entrega = $line['fecha_entrega'];
            $id_pedido = $field['IdPedido'];

            $to = "pepe@paratodohayfans.com";
            $subject = 'Compra Online FAILBOX';
            $message = "<html><head></head><body>";
            $message .= "<h4>Nombre del cliente: ".$nombre_cliente."</h4>";
            $message .= "<h4>Apellidos del cliente: ".$apellidos_cliente."</h4>";
            $message .= "<h4>E-mail del cliente: ".$email_cliente."</h4>";
            // $message .= "<h4>Teléfono del cliente: ".$telefono_cliente."</h4>";
            $message .= "<h4>ID de pedido: ".$id_pedido."</h4>";
            // $message .= "<h4>Orden de pedido: ".$orden_pedido."</h4>";
            $message .= "<h4>Fecha de entrega: Sin fecha.</h4>";
            $message .= "<h5>A continuación se muestra los productos del pedido que el cliente realizó: </h5><hr>";

            $query5 = "SELECT * FROM Productos_has_Pedidos pp
                      INNER JOIN Productos p ON p.IdProducto = pp.Productos_IdProducto
                      INNER JOIN Pedidos pe ON pe.IdPedido = pp.Pedidos_IdPedido
                      WHERE pp.Pedidos_IdPedido = $id_pedido";
            $result5 = mysql_query($query5) or die(mysql_error());

            while ($line5 = mysql_fetch_array($result5)) {

                $message .= "<h5>Nombre del producto: ".$line5['NombreProd']."</h5>";
                $message .= "<h5>Descripción: ".$line5['Descripcion']."</h5>";
                $message .= "<h5>Cantidad: ".$line5['Cantidad']." Precio: ".$line5['Precio']."</h5>";
                $subtotal = $line5['Cantidad'] * $line5['Precio'];
                $message .= "<h5>Subtotal: ".$subtotal."</h5>";
                $message .= "<hr>";

            }

            $message .= "<h4>Total de la Compra: $ ".$field['Total'].".00</h4>";

            $query6 = "SELECT * FROM DatosEnvios
                      WHERE IdPedido =  $id_pedido";
            $result6 = mysql_query($query6) or die(mysql_error());
            $lineresult = mysql_fetch_array($result6);
            if(mysql_num_rows($result6)>0){
                $message .= "<h4>El pedido cuenta con entrega al domicilio: <br></h4><br>";
                $message .= "<h5>".$lineresult['Direccion'].", CP: ".$lineresult['CP'].". Municipio: ".$lineresult['Ciudad'].", Estado: ".$lineresult['Estado'].", Colonia: ".$lineresult['Colonia']." <br></h5><br>";
                // $message .= "<h4>Con horario de: ".$horario_entrega."</h4><br>";
            }else{
                $message .= "<h4>Entrega en Failbox</h4><br>";
            }

            $message .= "</body></html>";

            $headers = "From: " . strip_tags($to) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($to) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            
            mail($to, $subject, $message, $headers);


            /* Email Cliente */
            $to = $email_cliente;
            // $to = "pepe@paratodohayfans.com";
            $email_failbox = "hola@failbox.mx";
            $subject = '!Tienda Failbox Online¡';
            $message = "<html><head></head><body>";
            // $message .= "<h1><img src='http://www.misegreta.com/img/misegreta_logo-01.png' width='280px' height='auto'></h1>";
            $message .= "<h4>Gracias ".$nombre_cliente." por tu compra en Misegreta.<br>Proporcionaste el número teléfonico: XX-XX-XX-XX </h4>";
            // $message .= "<h4>Tu orden de pedido es ".$orden_pedido." por favor guárdalo para futuras aclaraciones.</h4>";
            $message .= "<h4>Tu orden de pedido es ".$id_pedido." por favor guárdalo para futuras aclaraciones.</h4>";
            $message .= "<h4>La fecha de entrega está establecida para el día: Sin fecha. <br>
            Si tienes alguna duda o sugerencia mándanos un correo <br>a: hola@failbox.mx o llámanos al número: XX-XX-XX-XX.</h4>";
            $message .= "<h4></h4>";
            $message .= "<h4>A continuación se muestra los productos que ordenaste: </h4><hr>";


            $query_1 = "SELECT * FROM Productos_has_Pedidos pp
                      INNER JOIN Productos p ON p.IdProducto = pp.Productos_IdProducto
                      INNER JOIN Pedidos pe ON pe.IdPedido = pp.Pedidos_IdPedido
                      WHERE pp.Pedidos_IdPedido = $id_pedido";
            $result_1 = mysql_query($query_1) or die(mysql_error());
            
            while ($line_1 = mysql_fetch_array($result_1)) {

                $message .= "<h5>Nombre del producto: ".$line_1['NombreProd']."</h5>";
                $message .= "<h5>Descripción: ".$line_1['Descripcion']."</h5>";
                $message .= "<h5>Cantidad: ".$line_1['Cantidad']." Precio: ".$line_1['Precio']."</h5>";
                $subtotal = $line_1['Cantidad'] * $line_1['Precio'];
                $message .= "<h5>Subtotal: ".$subtotal."</h5>";
                $message .= "<hr>";

                $query_2 = "SELECT * FROM DatosEnvios
                      WHERE IdPedido =  $id_pedido";
                $result_2 = mysql_query($query_2) or die(mysql_error());
                $lineresult_1 = mysql_fetch_array($result_2);
                if(mysql_num_rows($result_2)>0){
                    $message .= "<h4>El pedido cuenta con entrega al domicilio: <br></h4><br>";
                    $message .= "<h5>".$lineresult['Direccion'].", CP: ".$lineresult['CP'].". Municipio: ".$lineresult['Ciudad'].", Estado: ".$lineresult['Estado'].", Colonia: ".$lineresult['Colonia']." <br></h5><br>";
                    // $message .= "<h4>Con horario de: ".$horario_entrega."</h4><br>";
                }else{
                    $message .= "<h4>Entrega en Failbox</h4><br>";
                }



            }
            $message .= "</body></html>";

            $headers = "From: " . strip_tags($email_failbox) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($to) . "\r\n";
            $headers .= "CC: ".$email_failbox."\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            mail($to, $subject, $message, $headers);

        } else if (strcmp ($res, "INVALID") == 0) {
            // El estado que devuelve es INVALIDO, la información no ha sido enviada por PayPal. Deberías guardarla en un log para comprobarlo después
        } 
    } else {    // Si no hay datos $_POST
        // Podemos guardar la incidencia en un log, redirigir a una URL...
    }
?>