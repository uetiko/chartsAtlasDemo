<?php
include_once '../com.ife.chart.vo/ProcesaVO.php';
include_once '../com.ife.chart.lib/JSON.php';


/**
 * 
 */
class DashboardAction{
	function __construct() {
		
	}
    
    public function executeGrafica(){
        $json = new Services_JSON();
        $vo = new ProcesaVO();
        return $json->encode($vo->procesaDFB01());
    }
    
    public function executeSelection(){
        
    }
    
    public function executeGraficaPorMesPais($mes){
        $vo = new ProcesaVO();
        $json = new Services_JSON();
        return $json->encode($vo->procesaDBFMes($mes));
    }
}

?>