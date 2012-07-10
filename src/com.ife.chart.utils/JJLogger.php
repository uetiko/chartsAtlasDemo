<?php
#Prototipo de log de errores en php
  /**
 * Clase para la creación de logs
 * @package com.ife.chart.utils
 * @author Angel Barrientos uetiko <at> gmail <dot> com
 * @copyright 2012
 * @license http://www.gnu.org/copyleft/lesser.html Distributed under the Lesser General Public License (LGPL)
 * @version 0.3
 */
class JJLogger {
	protected $logName;
	protected $dir;
	protected $err;
	protected $notes;
	protected $querys;

	/**
	 * Método que te permite crear diferentes logs.
	 * @param string $err Nombre del log de errores.
	 * @param string $note Nombre del log de notas.
	 * @param string $query Nombre del log donde se guardan los querys y su descripción
	 * @param string $dir Nombre del directorio donde se guardaran
	 */
	public function __construct($err, $note, $query, $dir){
		$this -> err = $err;
		$this -> notes = $note;
		$this -> querys = $query;
		$this -> dir = $dir;
	}

	/**
	 * Funcion para abrir el log y guardar el error que se genera
	 * @access protected
	 * @param $errorMsg Formato del mensaje de error creado.
	 * @param $logName Nombre del log donde se va a guardar.
	 * @method void guardar(string $errorMsg, string $logName)
	 * @return void
	 */
	protected function guardar($errorMsg, $logName) {
		if (is_dir($this -> dir)) {
			$logDir = $this -> dir . "/" . $logName . ".log";
			$openDir = fopen($logDir, "a+");
			fwrite($openDir, $errorMsg);
			fclose($openDir);
		}else{
			mkdir($this->dir, 0777); 
			$logDir = $this -> dir . "/" . $logName . ".log";
			$openDir = fopen($logDir, "a+");
			fwrite($openDir, $errorMsg);
			fclose($openDir);
		}

	}

	/**
	 * Método para definir el nivel del log
	 * 
	 * @param string $error Tipo de error
	 * @param string $msg Mensaje relacionado al error
	 * @param string $level Nivel del error. Niveles: SEVERE, WARNING, INFO, CONFIG, FINER, FINEST
	 * @access public
	 * @return void
	 * @method void log(string $error, string $msg, string $level) guarda un registro de los errorres.
	 *
	 */
	public function log($error, $msg, $level) {
		$fech = date("d-m-Y h:i:s");
		$body = "[$fech] [$level] $msg\n$error\n\n";
		$this -> guardar($body, $this -> err);
	}

	/**
	 * Metodo para guardar los querys generados
	 * @param string $query Query a guardar en el log
	 * @param string $desc Descripcion relacionado al query
	 * @access public
	 * @return void
	 * @method void querys(string $query, string $desc) guarda un registro de querys.
	 */
	public function querys($query, $desc) {
		$fech = date("d-m-Y h:i:s");
		$body = "--[$fech]\n -- Descripcion: $desc\n $query\n\n";
		$this -> guardar($body, $this -> querys);
	}

	/**
	 * Método para crear la cabecera del log para notas
	 * deprecated
	 * @access public
	 * @param string $header texto para el encabezado
	 * @return void
	 * @method void setHeaderNotes() Crea la fecha y hora con un encabezado 
	 */
	public function setHeaderNotes($header) {
		$fech = date("d-m-Y h:i:s");
		$desc = " $header: [$fech] \n";
		$this -> guardar($desc, $this -> notes);
	}
	/**
	 * Método para crear la cabecera del log para notas
	 * deprecated
	 * @access public
	 * @param string $data  a ser lanzado al log
	 * @return void
	 * @method void setBodyNotes(string $data) guarda una cadena de texto sin formato
	 */
	public function setBodyNotes($data) {
		$this -> guardar("$data\n", $this -> notes);
	}

}
?>
