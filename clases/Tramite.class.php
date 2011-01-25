<?php
class Tramite
{
	private $_matricula; //el dni de la persona [dni] (int)
	private $_apellido; //apellido de la persona que realiza el tramite [apellido] (varchar 45).
	private $_nombre; //nombre de la persona que realiza el tramite [nombre] (varchar 45).
	private $_clase; //el año en numero de nacimiento (ej: 1980) [clase] (int).
	private $_sexo; //Varón o Mujer (actualmente en la base esta en varchar 1, se cambia o se usa como V o M y despues se cambia en el print) [sexo] (varchar 1) .

	/**
	 * @return the _matricula
	 */
	public function get_matricula(){
		return $this->_matricula;
	}
	
	/**
	 * @param field_type _matricula
	 */
	public function set_matricula($value){
		$this->_matricula = $value;
	}
	
	/**
	 * @return the _apellido
	 */
	public function get_apellido(){
		return $this->_apellido;
	}
	
	/**
	 * @param field_type _apellido
	 */
	public function set_apellido($value){
		$this->_apellido = $value;
	}
	
	/**
	 * @return the _nombre
	 */
	public function get_nombre(){
		return $this->_nombre;
	}
	
	/**
	 * @param field_type _nombre
	 */
	public function set_nombre($value){
		$this->_nombre = $value;
	}
	
	/**
	 * @return the _clase
	 */
	public function get_clase(){
		return $this->_clase;
	}
	
	/**
	 * @param field_type _clase
	 */
	public function set_clase($value){
		$this->_clase = $value;
	}
	
	/**
	 * @return the _sexo
	 */
	public function get_sexo(){
		return $this->_sexo;
	}
	
	/**
	 * @param field_type _sexo
	 */
	public function set_sexo($value){
		$this->_sexo = $value;
	}
	


}