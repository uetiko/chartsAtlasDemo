<?php
include_once '../com.ife.chart.vo/ProcesaVO.php';
include_once '../com.ife.chart.lib/JSON.php';
include_once '../com.ife.chart.utils/JJUtils.php';

/**
 * @version 0.1
 * @author Angel Barrientos Cruz uetiko@gmail.com
 * @package com.ife.chart.action
 * @license Resevada para el Instituto Federal Electoral
 */
class PeticionAction{
	private $json;
	function __construct() {
		$this->json = new Services_JSON();
	}
    
    public function executeGetPais(){
        $vo = new ProcesaVO();
        return $this->json->encode($vo->getPais());
    }
    
    public function executePaisData($idPais){
        $vo = new ProcesaVO();
        $d = array('datos' => $vo->getPaisDatos($idPais), 'estado' => $vo->getOnlyEstados(), 'numeros' => $vo->getDatosEstados($idPais));
        return $this->json->encode($d);
    }
    
    public function executeGetFecha(){
        $utils = new JJUtils();
        $array = array('fecha' => $utils->getFechaActual());
        return $this->json->encode($array);
    }
    
    public function executeMapLink(){
        $vo = new ProcesaVO();
        $array = $vo->procesaLinkMap();
        //print_r($array);
        $format = array('nombre' => $array[0]['nombreCorto'], 'link' => $array[0]['link']);
        return $this->json->encode($format);
    }
}

?>