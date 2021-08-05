<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
          // Recibir vía POST los datos del formulario
          $firstname = $_POST["first-name"];
          $lastname = $_POST["last-name"];
          $phone = $_POST["phone"];
          $email = $_POST["email"];
          $mensaje = $_POST["message"];

          if (empty($email)){ // Validar si la dirección de correo no esta vacia
            $error=1;
            $mensaje="Correo electrónico vacío.";
            $datos=0;
          } else {

            $usuario_mail="menendezbruno@gmail.com"; // Direccion de envio
            $remite = "Formulario de Mi webpage"; //Nombre de Quien remite o envia
            $remite_email = "menendezbruno@gmail.com";
            $asunto = "Se envío un correo de contacto desde $remite";

            // Armar un mensaje html para el cuerpo del correo electrónico
            $mensaje = "<!doctype html>
            <html class=''><head><meta charset='utf-8'>
            <title>Han enviado los siguientes comentarios!</title>
            </head>
            <body>
            <h1>Contacto desde el sitio Estudio Juridico - Docampo & Asociados (Formulario de contacto)</h1>
            Nombre: ".$firstname.", Apellido: ".$lastname." <br clear='all'/>
            Correo: ".$email." <br clear='all'/>
            Numero Telefonico: ".$phone." <br clear='all'/>
            Mensaje: <br clear='all'/> ".$mensaje." <br clear='all'/>
            </body></html>";

            $cabeceras = "From: ".$remite." <".$remite_email.">\r\n";
            $cabeceras = $cabeceras."Mime-Version: 1.0\n";
            $cabeceras = $cabeceras.'Content-type: text/html; charset=utf-8' . "\r\n";

            // Realizar el envío con la función mail de php
            $enviar_email = mail($usuario_mail, $asunto, $mensaje, $cabeceras);

            if($enviar_email) { // Envío exitoso
              $error=0;
              $mensaje="Correo enviado";
              $datos=0;
            }else { // No se pudo enviar el correo
              $error=1;
              $mensaje="El correo no fue enviado";
              $datos=0;
            }

          }

        // Empaquetado de la respuesta en formato JSON
          $resp=[
            "error"=>$error,
            "mensaje"=>$mensaje,
            "datos"=>$datos,
          ];

        echo json_encode($resp);

        } else {
          $resp=[
           "error"=>1,
           "mensaje"=>"El servidor denego la peticion.",
           "datos"=>0
          ];
          echo json_encode($resp);
        }
        ?>