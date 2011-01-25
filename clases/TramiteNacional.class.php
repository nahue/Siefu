<?php
class Nacional extends Tramite
{
	private $_fecha; // fecha de nacimiento dd/mm/aaaa (en la base se graba aaaa/mm/dd) [fecha_nacimiento] (date).
    private $_nacion; // pais de nacimiento (poner por defecto argentina en el desplegable, pero que se pueda cambiar) [id_pais_nac] (int).
	private $_provincia; // provincia de nacimiento (usar clasificador, hay que ver el tema de provincias de otros paises) [provincia_nac] (varchar 35) “cambiar en la base el tipo de campo”.
	private $_partido_depto; // es partido o depto de la provincia (ej: florida, partido de vicente lopez, ver si usar clasificador) [partido_dtop_nac] (varchar 45).
	private $_localidad;// es la localidad de nacimiento (cambiar el clasificador de localidades mundiales) [localidad_nac] (varchar 35) “cambiar en la base el tipo de campo”.
	private $_estadocivil; // estado civil (id busca la descripcion en tabla “estado_civil” campos: id_estado_civil / descripcion) [id_estado_civil] (int).

	
	/**
	 * @return the _fecha
	 */
	public function get_fecha($imprimir){
		return $this->_fecha;
	}
	
	/**
	 * @param field_type _fecha
	 */
	public function set_fecha($value){
		$this->_fecha = $value;
	}
	
	/**
	 * @return the _nacion
	 */
	public function get_nacion(){
		return $this->_nacion;
	}
	
	/**
	 * @param field_type _nacion
	 */
	public function set_nacion($value){
		$this->_nacion = $value;
	}
	
	/**
	 * @return the _provincia
	 */
	public function get_provincia(){
		return $this->_provincia;
	}
	
	/**
	 * @param field_type _provincia
	 */
	public function set_provincia($value){
		$this->_provincia = $value;
	}
	
	/**
	 * @return the _partido_depto
	 */
	public function get_partido_depto(){
		return $this->_partido_depto;
	}
	
	/**
	 * @param field_type _partido_depto
	 */
	public function set_partido_depto($value){
		$this->_partido_depto = $value;
	}
	
	/**
	 * @return the _localidad
	 */
	public function get_localidad(){
		return $this->_localidad;
	}
	
	/**
	 * @param field_type _localidad
	 */
	public function set_localidad($value){
		$this->_localidad = $value;
	}
	
	/**
	 * @return the _estadocivil
	 */
	public function get_estadocivil(){
		return $this->_estadocivil;
	}
	
	/**
	 * @param field_type _estadocivil
	 */
	public function set_estadocivil($value){
		$this->_estadocivil = $value;
	}
	

	
	
}