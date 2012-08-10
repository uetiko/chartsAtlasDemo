<?php

/**
 *
 */
class GraficaTipoUtils {

    function __construct() {

    }

    public static function datosGraficaOctMay(array $dataArray, array $tags) {
        $cat = array();
        $val = array();
        foreach ($dataArray[1] as $key) {
            $cat[] = $key;
        }
        foreach ($dataArray[2] as $key) {
            $val[] = $key;
        }
        $datos = array('reporte' => array($tags[1], $tags[2], $tags[3], $tags[5], 'categorias' => $cat, 
            'valores1' => array($tags[6], 'datos' => $val)
        ));
    }

    public static function datosGraficaPorMes(array $dataArray, array $tags) {

    }

    /**
     *
     */
    public static function tagsGraficas($nombreGrafica, $subNombre, $ejeY, $ejeX, $unidadesY, $unidadesX, $valNombre1, $valNombre2, $total) {
        $tags = array(
            1 => array('nombreGrafica' => $nombreGrafica), 
            2 => array('subnombre' => $subNombre), 
            3 => array('ejeYTitulo' => $ejeY), 
            4 => array('unidadesY' => $unidadesY), 
            5 => array('ejeXTitulo' => $ejeY), 
            6 => array('nombre' => $valNombre1), 
            7 => array('nombre' => $valNombre2),
            8 => array('totalCiudadanos' => $total));
        return $tags;
    }

}
?>