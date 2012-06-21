<?php
include_once '../com.ife.chart.vo/ProcesaVO.php';
include_once '../com.ife.chart.lib/JSON.php';

/**
 * 
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
}

?>