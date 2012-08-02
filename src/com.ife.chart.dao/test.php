<?php
include '../com.ife.chart.dao/ConnectionXbase.php';
include_once '../com.ife.chart.config/DBConfig.php';

$conf = new DBConfig();
echo "path: " . $conf->getXbasePath() . "\n nombre: " . $conf->getXbases('uno') . "\n";


$testDao = new ConnectionXbase($conf->getXbasePath(), $conf->getXbases('uno'));
$testDao->openDBF();
$num = $testDao->getRecordNumber();
echo "Numero: " . $num;
$data = array();
$data = $testDao->getDataArray($num);
//print_r($data);
$total = 0;
foreach ($data as $key) {
    $total += $key['TOTAL_MAY'];
}
echo "\n total:: " . $total . "\n";
$testDao->closeDBF();



?>