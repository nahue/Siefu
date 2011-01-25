<?php
class Controlador
{
	private $_nombre;
	private $_ctlArchivo;
	private $_archivo;
	private $_template = "defecto.tpl";
	private $_tplDirectorio = "templates";
	private $_existeControlador = false;
        private $_perfil;
	private $_html;
        protected $_config = array();
        
        public function  __construct() {

            $this->_perfil = new Perfil();
            
        }

	public function cargar($controlador)
	{
		//fb::log("Cargando controlador...");
		$controladorArchivo = RUTA."/controladores/$controlador.php";

		if (file_exists($controladorArchivo)) {
			
			$this->_nombre = ucfirst($controlador);
			$this->_archivo = $controlador.".php";
			$this->_existeControlador = true;
		} else {			
			header("HTTP/1.0 404 Not Found");
		}
		

	}
	
	public function mostrar()
	{
                
		if ($this->_existeControlador)
			include("controladores/".$this->_archivo);
		else 
			include("errores/404.php");
	}
	
	public function obtenerNombre()
	{
		return $this->_nombre;
	}

        public function get_perfil() {
            return $this->_perfil;
        }

        public function get_config() {
            include("config.inc.php");
            return $config;
        }


        


}