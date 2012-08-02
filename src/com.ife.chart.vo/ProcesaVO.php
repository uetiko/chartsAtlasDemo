<?php
include_once '../com.ife.chart.dao/ReadDBFDAO.php';
include_once '../com.ife.chart.dao/QueryDAO.php';

/**
 * Clase de VO para el procesamiento de datos comunes
 * @version 0.1
 * @author Angel Barrientos Cruz <uetiko@gmail.com>
 * @package com.ife.chart.vo
 * @license http://www.gnu.org/copyleft/lesser.html Distributed under the Lesser General Public License (LGPL)
 * @copyright 2012
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

    public function getOnlyEstados() {
        return $edo = array("Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Chiapas", "Chihuahua", "Coahuila", "Colima", "Distrito Federal", "Durango", "Guanajuato", "Guerrero", "Hidalgo", "Jalisco", "México (Estado)", "Michoacán", "Morelos", "Nayarit", "Nuevo León", "Oaxaca", "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí", "Sinaloa", "Sonora", "Tabasco", "Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán");
    }

    public function getDatosEstados($idPais) {
        $dao = new ReadDBFDAO('demo');
        $data = $dao -> getDataDbf();
        $datos;
        foreach ($data as $key) {
            if ($key['ID_PAIS'] == $idPais) {
                $datos = array($key['AGS_2010'], $key['BC_10'], $key['BCS_2010'], $key['CAM_2010'], $key['CHIS_2010'], $key['CHIH_2010'], $key['COAH_2010'], $key['COL_2010'], $key['DF_2010'], $key['DGO_2010'], $key['GTO_2010'], $key['GRO_2010'], $key['HGO_2010'], $key['JAL_2010'], $key['MEX_2010'], $key['MICH_2010'], $key['MOR_2010'], $key['NAY_2010'], $key['NL_2010'], $key['OAX_2010'], $key['PUE_2010'], $key['QRO_2010'], $key['QR_2010'], $key['SLP_2010'], $key['SIN_2010'], $key['SON_2010'], $key['TAB_2010'], $key['TAMPS_2010'], $key['TLAX_2010'], $key['VER_2010'], $key['YUC_2010'], $key['ZAC_2010']);
                break;
            }
        }
        return $datos;
    }

    public function procesaLinkMap() {
        $dao = new QueryDAO();
        $links = $dao -> getLinks();
        $data = array();
        foreach ($links as $key) {
            if ($key['nombreCorto'] == 'mapguide') {
                $data[] = $key;
                break;
            }
        }
        return $data;
    }

    public function procesaDFB01() {
        $dao = new ReadDBFDAO('uno');
        $data = $dao -> getDataDbf();
        $totalOct = 0;
        $totalNov = 0;
        $totalDic = 0;
        $totalEne = 0;
        $totalFeb = 0;
        $totalMar = 0;
        $totalAbr = 0;
        $totalMay = 0;
        foreach ($data as $key) {
            $totalOct += $key['TOTAL_OCT'];
            $totalNov += $key['TOTAL_NOV'];
            $totalDic += $key['TOTAL_DIC'];
            $totalEne += $key['TOTAL_ENE'];
            $totalFeb += $key['TOTAL_FEB'];
            $totalMar += $key['TOTAL_MAR'];
            $totalAbr += $key['TOTAL_ABR'];
            $totalMay += $key['TOTAL_MAY'];
        }
        $totalArray = array('Octubre' => $totalOct, 'Noviembre' => $totalNov, 'Diciembre' => $totalDic, 'Enero' => $totalEne, 'Febrero' => $totalFeb, 'Marzo' => $totalMar, 'Abril' => $totalAbr, 'Mayo' => $totalMay);
        return $totalArray;
    }

    public function procesaDFB01Pais() {
        $dao = new ReadDBFDAO('uno');
        $data = $dao -> getDataDbf();
        foreach ($data as $key) {
            if($key['TOTAL_OCT'] != 0){
                echo utf8_encode($key['NOM_ESPAN'])  ."\n";
                echo $key['TOTAL_OCT'];
                echo "\n\n";
            }
            
            
        }
    }

}
?>