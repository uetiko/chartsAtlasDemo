<?php
include_once '../com.ife.chart.utils/JJUtils.php';
include_once '../com.ife.chart.vo/ProcesaVO.php';
include_once '../com.ife.chart.utils/GraficaTipoUtils.php';
include_once '../com.ife.chart.lib/JSON.php';

$test = new JJUtils();
$pvo = new ProcesaVO();

echo $test->getFechaActual() . "\n";
//print_r($pvo->procesaDBFMes("octMay"));
//
/*print_r(GraficaTipoUtils::tagsGraficas("hola", "subNombre", "ejeY", "ejeX", "unidadesY", "unidadesX", "valNombre1", "valNombre2"));
$json = new Services_JSON();
echo "\n\n";
$c = GraficaTipoUtils::tagsGraficas("hola", "subNombre", "ejeY", "ejeX", "unidadesY", "unidadesX", "valNombre1", "valNombre2");
$d = array();
foreach ($c as $key) {
	foreach ($key as $value) {
		$d[] = $value;
	}
}*/
//echo $json->encode($d);
print_r($pvo->getMapaPorMes("OCTMAY", array("hola"=> "hola", array("adios"=> "chao"))));
?>
