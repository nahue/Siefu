<?php

require("../config.inc.php");
require("../DoctrineBootstrap.php");
require("../clases/class.phpmailer.php");
require("../clases/class.smtp.php");
require("../clases/Crypt.class.php");
$usuario = Doctrine_Core::getTable("Usuario")->findOneByEmail($_POST["email"]);

if ($usuario) {

    $claveAleatoria = Crypt::claveAleatoria();
    $usuario->pass = $claveAleatoria;
    $usuario->save();
    $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

    $mail->IsSMTP(); // telling the class to use SMTP
    $datos = array();
    try {
        $mail->Host = $config["mail"]["host"]; // SMTP server
        $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth = false;                  // enable SMTP authentication
        $mail->Host = $config["mail"]["host"];  // sets the SMTP server
        //$mail->Port       = 26;                    // set the SMTP port for the GMAIL server
        $mail->Username = $config["mail"]["user"]; // SMTP account username
        $mail->Password = $config["mail"]["pass"];        // SMTP account password

        $mail->AddAddress($_POST["email"], $_POST["email"]);
        $mail->SetFrom('siefu@tierradelfuego.gov.ar', "Siefu");
        //$mail->AddReplyTo($_POST["correo_electronico"], $_POST["nombre_apellido"]);
        $mail->Subject = "SIEFU :: Reseteo de password de ingreso al sistema";
        $mail->AltBody = $config["mail"]["textoAlternativo"]; // optional - MsgHTML will create an alternate automatically
        $mail->MsgHTML(utf8_decode("Su clave es: $claveAleatoria"));

        $mail->Send();
        $datos["respuesta"] = true;

    } catch (phpmailerException $e) {
        //$datos["respuesta"] = $e->errorMessage(); //Pretty error messages from PHPMailer
        $datos["respuesta"] = "Hubo un error al enviar el correo";

    } catch (Exception $e) {
        //$datos["respuesta"] = $e->getMessage(); //Boring error messages from anything else!
        $datos["respuesta"] = "Hubo un error al enviar el correo";
        
    }
}
else
    $datos["respuesta"] = false;

echo json_encode($datos);