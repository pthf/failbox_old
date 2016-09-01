<?php 
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

            /* Email Failbox*/
            $id_pedido = $_GET['num'];
            $query4 = "SELECT * FROM Pedidos p INNER JOIN Usuarios u ON u.IdUsuario = p.Usuarios_IdUsuario WHERE p.IdPedido = '".$id_pedido."'";
            $result4 = mysql_query($query4,Conectar::con()) or die (mysql_error());
            $field = mysql_fetch_array($result4);

            $orden_pedido = $field['OrdenPedido'];
            $nombre_cliente = $field['Nombre'];
            $apellidos_cliente = $field['Apellido'];
            $email_cliente = $field['Email'];
            // $telefono_cliente = $field['Email'];
            $fecha_pedido = $field['FechaPedido'];
            $fecha_entrega = $field['FechaEntrega'];
            $id_pedido = $field['IdPedido'];

            $to = "pepe@paratodohayfans.com";
            $subject = 'Compra Online FAILBOX';
            $message = "<html><head></head><body>";
            $message .= "<h1><img src='http://localhost/www/failbox/build/admin/images/logo_failbox.png' width='280px' height='auto'></h1>";
            $message .= "<span style='font-family:Gotham-Light;'>Gracias por su interes en los Productos de Failbox. <br>Su Orden ha sido recibida y será procesada una vez el Pago haya sido confirmado.</span>"; 
            ?>
            <style>
            table, th, td {
                border: 1px solid #97999c;
                border-collapse: collapse;
                padding: 5px;
                text-align: center;
                font-family: 'Gotham-Light';
            }
            .noborder {
                border: 1px solid white;
            }
            .color-title-table {
                background: #70B153;
                color: #FFF;
            }
            span {
                font-family: 'Gotham-Light';
            }
            </style>
            <?php
            $message .= "<table style='width:40%;margin-top: 2%;'>
                          <tr>
                            <th class='color-title-table'>Detalles de la Orden</th>
                            <th class='color-title-table'>Detalles de la Orden</th>
                          </tr>
                          <tr>
                            <td>
                                ID de Orden: $orden_pedido<br>
                                Fecha de Orden: $fecha_pedido<br>
                                Fecha de Pago: $fecha_entrega<br>
                                Fecha de Envio: $fecha_entrega<br>
                            </td>
                            <td>
                                Email: $email_cliente<br>
                                Telefono: 36363636<br>
                            </td>
                          </tr>
                        </table>";

            $query6 = "SELECT * FROM DatosEnvios
                      WHERE IdPedido =  $id_pedido";
            $result6 = mysql_query($query6) or die(mysql_error());
            $lineresult = mysql_fetch_array($result6);
            if(mysql_num_rows($result6)>0){

                $message .= "<table style='width:40%;margin-top: 2%;margin-bottom: 2%;'>
                          <tr class='color-title-table'>
                            <th>Direccion de Pago</th>
                          </tr>
                          <tr>
                            <td>
                                $nombre_cliente<br>
                                ".$lineresult['Direccion']."<br>
                                ".$lineresult['Colonia']."<br>
                                ".$lineresult['CP']."<br>
                                ".$lineresult['Ciudad']."<br>
                                ".$lineresult['Estado']."<br>
                            </td>
                          </tr>
                        </table>";


                $query5 = "SELECT * FROM Productos_has_Pedidos pp
                          INNER JOIN Productos p ON p.IdProducto = pp.Productos_IdProducto
                          INNER JOIN Pedidos pe ON pe.IdPedido = pp.Pedidos_IdPedido
                          WHERE pp.Pedidos_IdPedido = $id_pedido";
                $result5 = mysql_query($query5) or die(mysql_error());

                $message .= "<table style='width:40%;margin-top: 2%;margin-bottom: 2%;'>
                          <tr class='color-title-table'>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Modelo</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                          </tr>
                ";
                $costo_envio = 0;
                $sub_total = 0;
                while ($line5 = mysql_fetch_array($result5)) {
                    $subtotal = $line5['Cantidad'] * $line5['Precio'];
                    $costo_envio = $costo_envio + $line5['CostoEnvio']; 
                    $sub_total = $sub_total + $subtotal;
                    $images = explode(',', $line5['Image']);
                    $message .= "
                          <tr>
                            <td><img src='../admin/images/products/".$images[0]."' width='80px' height='auto'></td>
                            <td>".$line5['NombreProd']."</td>
                            <td>".$line5['Modelo']."</td>
                            <td>".$line5['Cantidad']."</td>
                            <td>".$line5['Precio']."</td>
                            <td>".$subtotal."</td>
                          </tr>";

                }

                 $message .= "
                        <tr>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder' style='border-right: 1px solid #97999c;'></th>
                            <th>Subtotal:</th>
                            <th>$ $sub_total.00</th>
                        </tr>
                        <tr>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder' style='border-right: 1px solid #97999c;'></th>
                            <th>Costo Envio:</th>
                            <th>$ $costo_envio.00</th>
                        </tr>
                        <tr>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder' style='border-right: 1px solid #97999c;'></th>
                            <th>Total:</th>
                            <th>$ ".$field['Total'].".00</th>
                        </tr>
                        </table>";

                // $message .= "<h4>Total de la Compra: $ ".$field['Total'].".00</h4>";

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
            $message .= "<h1><img src='http://localhost/www/failbox/build/admin/images/logo_failbox.png' width='280px' height='auto'></h1>";
            $message .= "<span>Gracias ".$nombre_cliente." por tu compra en Failbox.<br>Proporcionaste el número teléfonico: XX-XX-XX-XX.<br></span>";
            $message .= "<span><br></span>";
            $message .= "<span>Tu orden de pedido es '".$orden_pedido."' por favor guárdalo para futuras aclaraciones.</span><br>";
            $message .= "<span>La fecha de entrega está establecida para el día: Sin fecha.<br>";
            $message .= "<span><br></span>";
            $message .= "<span>Si tienes alguna duda o sugerencia mándanos un correo <br>a: hola@failbox.mx o llámanos al número: XX-XX-XX-XX.</span><br>";
            $message .= "<span><br></span>";
            $message .= "<span>A continuación se muestra los productos que ordenaste: </span>";
            ?>
            <style>
            table, th, td {
                border: 1px solid #97999c;
                border-collapse: collapse;
                padding: 5px;
                text-align: center;
                font-family: 'Gotham-Light';
            }
            .noborder {
                border: 1px solid white;
            }
            .color-title-table {
                background: #70B153;
                color: #FFF;
            }
            span {
                font-family: 'Gotham-Light';
            }
            </style>
            <?php
            $message .= "<table style='width:40%;margin-top: 2%;'>
                          <tr>
                            <th class='color-title-table'>Detalles de la Orden</th>
                            <th class='color-title-table'>Detalles de la Orden</th>
                          </tr>
                          <tr>
                            <td>
                                ID de Orden: $orden_pedido<br>
                                Fecha de Orden: $fecha_pedido<br>
                                Fecha de Pago: $fecha_entrega<br>
                                Fecha de Envio: $fecha_entrega<br>
                            </td>
                            <td>
                                Email: $email_cliente<br>
                                Telefono: 36363636<br>
                            </td>
                          </tr>
                        </table>";

            $query6 = "SELECT * FROM DatosEnvios
                      WHERE IdPedido =  $id_pedido";
            $result6 = mysql_query($query6) or die(mysql_error());
            $lineresult = mysql_fetch_array($result6);
            if(mysql_num_rows($result6)>0){

                $message .= "<table style='width:40%;margin-top: 2%;margin-bottom: 2%;'>
                          <tr class='color-title-table'>
                            <th>Direccion de Pago</th>
                          </tr>
                          <tr>
                            <td>
                                $nombre_cliente<br>
                                ".$lineresult['Direccion']."<br>
                                ".$lineresult['Colonia']."<br>
                                ".$lineresult['CP']."<br>
                                ".$lineresult['Ciudad']."<br>
                                ".$lineresult['Estado']."<br>
                            </td>
                          </tr>
                        </table>";


                $query5 = "SELECT * FROM Productos_has_Pedidos pp
                          INNER JOIN Productos p ON p.IdProducto = pp.Productos_IdProducto
                          INNER JOIN Pedidos pe ON pe.IdPedido = pp.Pedidos_IdPedido
                          WHERE pp.Pedidos_IdPedido = $id_pedido";
                $result5 = mysql_query($query5) or die(mysql_error());

                $message .= "<table style='width:40%;margin-top: 2%;margin-bottom: 2%;'>
                          <tr class='color-title-table'>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Modelo</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                          </tr>
                ";
                $costo_envio = 0;
                $sub_total = 0;
                while ($line5 = mysql_fetch_array($result5)) {
                    $subtotal = $line5['Cantidad'] * $line5['Precio'];
                    $costo_envio = $costo_envio + $line5['CostoEnvio']; 
                    $sub_total = $sub_total + $subtotal;
                    $images = explode(',', $line5['Image']);
                    $message .= "
                          <tr>
                            <td><img src='../admin/images/products/".$images[0]."' width='80px' height='auto'></td>
                            <td>".$line5['NombreProd']."</td>
                            <td>".$line5['Modelo']."</td>
                            <td>".$line5['Cantidad']."</td>
                            <td>".$line5['Precio']."</td>
                            <td>".$subtotal."</td>
                          </tr>";

                }

                 $message .= "
                        <tr>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder' style='border-right: 1px solid #97999c;'></th>
                            <th>Subtotal:</th>
                            <th>$ $sub_total.00</th>
                        </tr>
                        <tr>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder' style='border-right: 1px solid #97999c;'></th>
                            <th>Costo Envio:</th>
                            <th>$ $costo_envio.00</th>
                        </tr>
                        <tr>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder'></th>
                            <th class='noborder' style='border-right: 1px solid #97999c;'></th>
                            <th>Total:</th>
                            <th>$ ".$field['Total'].".00</th>
                        </tr>
                        </table>";

                // $message .= "<h4>Total de la Compra: $ ".$field['Total'].".00</h4>";

            }else{
                $message .= "<h4>Entrega en Failbox</h4><br>";
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