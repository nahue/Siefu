<?php

/**
 * webtdf@tierradelfuego.gov.ar - Tdf529gob
 */

require("../clases/class.phpmailer.php");
require("../clases/class.smtp.php");
require("../config.inc.php");
$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP
$datos = array();
try {
  $mail->Host       = $config["mail"]["host"]; // SMTP server
  $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = false;                  // enable SMTP authentication
  $mail->Host       = $config["mail"]["host"];  // sets the SMTP server
  //$mail->Port       = 26;                    // set the SMTP port for the GMAIL server
  $mail->Username   = $config["mail"]["user"]; // SMTP account username
  $mail->Password   = $config["mail"]["pass"];        // SMTP account password
  //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mail->AddAddress($config["mail"]["correoDestino"], $config["mail"]["nombreDestino"]);
  $mail->SetFrom($_POST["correo_electronico"], $_POST["nombre_apellido"]);
  $mail->AddReplyTo($_POST["correo_electronico"], $_POST["nombre_apellido"]);
  $mail->Subject = $config["mail"]["asunto"];
  $mail->AltBody = $config["mail"]["textoAlternativo"]; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML(utf8_decode($_POST["mensaje"]));

  $mail->Send();
  $datos["respuesta"] = "true";
  echo json_encode($datos);
} catch (phpmailerException $e) {
  //$datos["respuesta"] = $e->errorMessage(); //Pretty error messages from PHPMailer
    $datos["respuesta"] = "Hubo un error al enviar el correo";
  echo json_encode($datos);
} catch (Exception $e) {
  //$datos["respuesta"] = $e->getMessage(); //Boring error messages from anything else!
    $datos["respuesta"] = "Hubo un error al enviar el correo";
  echo json_encode($datos);
}
