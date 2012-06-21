<?php
include_once '../com.ife.chart.dao/ReadDBFDAO.php';

/**
 *
 */
class ProcesaVO {

    function __construct() {

    }

    public function getPais() {
        $dbf = new ReadDBFDAO();
        $data = array();
        $listPais = array();
        $data = $dbf -> getDataDbf();
        foreach ($data as $key) {
            $arrayName = array('idPais' => $key['ID_PAIS'], 'nombre' => trim($key['NOMBRE']));
            $listPais[] = $arrayName;
        }
        return $listPais;
    }

    /**
     *
     */
    public function getPaisDatos($idPais) {
        $dbf = new ReadDBFDAO();
        $arrayData = array();
        $paisData = array();
        $arrayData = $dbf -> getDataDbf();
        foreach ($arrayData as $key) {
            if ($key['ID_PAIS'] == $idPais) {
                $paisData = $key;
                break;
            }
        }
        return $paisData;
    }

    public function getEstados() {
        $estados = array('AGS_2010' => 'Aguascalientes', 'BC_10' => 'Baja California', 'BCS_2010' => 'Baja California Sur', 'CAM_2010' => 'Campeche', 'CHIS_2010' => 'Chiapas', 'CHIH_2010' => 'Chihuahua', 'COAH_2010' => 'Coahuila', 'COL_2010' => 'Colima', 'DF_2010' => 'Distrito Federal', 'DGO_2010' => 'Durango', 'GTO_2010' => 'Guanajuato', 'GRO_2010' => 'Guerrero', 'HGO_2010' => 'Hidalgo', 'JAL_2010' => 'Jalisco', 'MEX_2010' => 'México (Estado)', 'MICH_2010' => 'Michoacán', 'MOR_2010' => 'Morelos', 'NAY_2010' => 'Nayarit', 'NL_2010' => 'Nuevo León', 'OAX_2010' => 'Oaxaca', 'PUE_2010' => 'Puebla', 'QRO_2010' => 'Querétaro', 'QR_2010' => 'Quintana Roo', 'SLP_2010' => 'San Luis Potosí', 'SIN_2010' => 'Sinaloa', 'SON_2010' => 'Sonora', 'TAB_2010' => 'Tabasco', 'TAMPS_2010' => 'Tamaulipas', 'TLAX_2010' => 'Tlaxcala', 'VER_2010' => 'Veracruz', 'YUC_2010' => 'Yucatán', 'ZAC_2010' => 'Zacatecas');
        return $estados;
    }
    
    public function getOnlyEstados(){
        return $edo = array("Aguascalientes","Baja California","Baja California Sur","Campeche","Chiapas","Chihuahua","Coahuila","Colima","Distrito Federal","Durango","Guanajuato","Guerrero","Hidalgo","Jalisco","México (Estado)","Michoacán","Morelos","Nayarit","Nuevo León","Oaxaca","Puebla","Querétaro","Quintana Roo","San Luis Potosí","Sinaloa","Sonora","Tabasco","Tamaulipas","Tlaxcala","Veracruz","Yucatán");
    }
    
    public function getDatosEstados($idPais){
        $dao = new ReadDBFDAO();
        $data = $dao->getDataDbf();
        $datos;
        foreach ($data as $key) {
            if($key['ID_PAIS'] == $idPais){
                $datos = array($key['AGS_2010'], $key['BC_10'], $key['BCS_2010'], $key['CAM_2010'], $key['CHIS_2010'], $key['CHIH_2010'], $key['COAH_2010'], $key['COL_2010'], $key['DF_2010'], $key['DGO_2010'], $key['GTO_2010'], $key['GRO_2010'], $key['HGO_2010'], $key['JAL_2010'], $key['MEX_2010'], $key['MICH_2010'], $key['MOR_2010'], $key['NAY_2010'], $key['NL_2010'], $key['OAX_2010'], $key['PUE_2010'], $key['QRO_2010'], $key['QR_2010'], $key['SLP_2010'], $key['SIN_2010'], $key['SON_2010'], $key['TAB_2010'], $key['TAMPS_2010'], $key['TLAX_2010'], $key['VER_2010'], $key['YUC_2010'], $key['ZAC_2010']);
                break;
            }
        }
        return $datos;
    }

}
?>