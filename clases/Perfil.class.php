<?php

/**
 * Description of Perfil
 *
 * @author strato1986
 */
class Perfil extends Controlador {

    protected $_errores = array();
    protected $_sesion;
    private $_logueado = false;

    public function __construct() {
        $this->_sesion = & $_SESSION;
    }

    /**
     * Inicia la sesion para el usuario
     * @param string $usuario
     * @param string $contrasenia
     * @return boolean
     */
    public function login($usuario, $contrasenia) {


        if (empty($usuario)) {
            $this->_errores[] = "Debe ingresar un usuario";

            if (empty($contrasenia)) {
                $this->_errores[] = "Debe ingresar una contraseña";
            }

            return false;
        }


        $listadoUsuarios = Doctrine_Core::getTable("Usuario");

        //$usuarioLogin = $listadoUsuarios->findOneByUsuario($usuario);
        $q = Doctrine_Query::create()
                        ->select('u.*, e.*')
                        ->from('Usuario u')
                        ->where('u.usuario = ?', $usuario)
                        ->leftJoin('u.Entidad e');
        $usuarioLogin = $q->execute()->toArray();
        if ($usuarioLogin) {

            if ($contrasenia != $usuarioLogin[0]["pass"]) {
                $this->_errores[] = "La contraseña no es valida";
                return false;
            } else {
                // EL USUARIO INICIO SESION CORRECTAMENTE
                $_SESSION["logueado"] = true;
                $_SESSION["usuario"] = $usuarioLogin[0];
                return true;
            }
            unset($datos);
        } else {
            $this->_errores[] = "Usuario no valido";
            return false;
        }
    }

    public function logout() {
        session_destroy();
    }

    public function obtenerErrores() {
        return $this->_errores;
    }

    public function logueado() {
        return $this->_sesion;
    }

    public function esAdmin() {
        if (isset($this->_sesion["usuario"]["admin"]))
            return $this->_sesion["usuario"]["admin"];
        else
            return false;
    }

    /**
     *
     * @param <type> $email
     * @param <type> $nombre
     * @return <type> 
     */
    public function notificarUsuario($email, $nombre, $contrasenia) {
        require("class.phpmailer.php");
        require("class.smtp.php");
        $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
        $mail->IsSMTP(); // telling the class to use SMTP

        $config = $this->get_config();

        try {
            $mail->Host = $config["mail"]["host"]; // SMTP server
            $mail->SMTPDebug = $config["mail"]["SMTPDebug"]; // enables SMTP debug information (for testing)
            $mail->SMTPAuth = false;                  // enable SMTP authentication
            $mail->Host = $config["mail"]["host"];  // sets the SMTP server
            //$mail->Port       = 26;                    // set the SMTP port for the GMAIL server
            $mail->Username = $config["mail"]["user"]; // SMTP account username
            $mail->Password = $config["mail"]["pass"];        // SMTP account password
            //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
            $mail->AddAddress($email, $config["mail"]["nombreDestino"]);
            $mail->SetFrom($config["mail"]["correoOrigen"], $nombre);
            $mail->AddReplyTo($config["mail"]["correoOrigen"], $config["mail"]["correoOrigen"]);
            $mail->Subject = $config["mail"]["asunto"];
            $mail->AltBody = $config["mail"]["textoAlternativo"]; // optional - MsgHTML will create an alternate automatically
            $mail->MsgHTML(utf8_decode("$nombre. Su contraseña es: $contrasenia"));

            $mail->Send();
            return true;
        } catch (phpmailerException $e) {
            //$datos["respuesta"] = $e->errorMessage(); //Pretty error messages from PHPMailer
            return false;
        } catch (Exception $e) {
            //$datos["respuesta"] = $e->getMessage(); //Boring error messages from anything else!
            return false;
        }
        
    }

    public function set_flash($mensaje)
    {
        $this->_sesion["flash"] = $mensaje;
    }

    public function get_flash()
    {
        return isset($this->_sesion["flash"]) ?  $this->_sesion["flash"] :  null;
    }



}

?>
