<?php

/**
 *
 */
class GraficaTipoUtils {

    function __construct() {

    }

    static public function datosGraficaOctMay(array $dataArray, array $tags) {
        /*$cat = array();
        $val = array();
        print_r($dataArray);
        foreach ($dataArray[1] as $key) {
            $cat[] = $key;
        }
        foreach ($dataArray[2] as $key) {
            $val[] = $key;
        }
        print_r($cat);
        return $datos = array('reporte' => array($tags[1], $tags[2], $tags[3], $tags[5], 'categorias' => $cat, 
            'valores1' => array($tags[6], 'datos' => $val)
        ));*/
        return array('hola' => "adios");
    }

    static public function datosGraficaPorMes(array $dataArray, array $tags) {

    }

    /**
     *
     */
    static public function tagsGraficas($nombreGrafica, $subNombre, $ejeY, $ejeX, $unidadesY, $unidadesX, $valNombre1, $valNombre2, $total) {
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
    
    
    static public function tagsOctNov(){
        $tags = array(
            1 => array('nombreGrafica' => 'Mexicanos en el mundo'), 
            2 => array('subnombre' => 'Gráfica de Octubre a Mayo'), 
            3 => array('ejeYTitulo' => $ejeY), 
            4 => array('unidadesY' => $unidadesY), 
            5 => array('ejeXTitulo' => $ejeY), 
            6 => array('nombre' => $valNombre1), 
            7 => array('nombre' => ''),
            8 => array('totalCiudadanos' => 'Ciudadanos en total'));
        return $tags;
    }

}
?>