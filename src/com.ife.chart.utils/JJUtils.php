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
    
    static public function getTags(){
        
    }
    
    static public function getMeses(){
        return array(
            'OCT' => 'Octubre',
            'NOV' => 'Noviembre',
            'DIC' => 'Diciempre',
            'ENE' => 'Enero',
            'FEB' => 'Febrero',
            'MAR' => 'Marzo',
            'ABR' => 'abril',
            'MAY' => 'Mayo'
        );
    }
}

?>