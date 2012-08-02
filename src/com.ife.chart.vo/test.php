<?php
include_once '../com.ife.chart.utils/JJUtils.php';
include_once '../com.ife.chart.vo/ProcesaVO.php';

$test = new JJUtils();
$pvo = new ProcesaVO();

echo $test->getFechaActual() . "\n";
echo 
print_r($pvo->procesaDBFMes("DIC"));

?>