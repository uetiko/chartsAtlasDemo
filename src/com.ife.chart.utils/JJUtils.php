<?php

/**
 * @version 0.1
 * @author Angel Barrientos Cruz uetiko@gmail.com
 * @package com.ife.chart.utils
 * @license Resevada para el Instituto Federal Electotal
 */
class JJUtils{
	
	function __construct() {
		date_default_timezone_set('America/Mexico_City');
	}
    
    public function getFechaActual(){
        $dia = date("j");
        $mes = date("F");
        $annio = date("Y");
        return $dia . ' de ' .  $mes . ' del ' . $annio;
    }
    
    public function getFormat(){
        
    }
}

?>