<?php
include '../com.ife.chart.dao/ConnectionXbase.php';
include_once '../com.ife.chart.config/DBConfig.php';

$conf = new DBConfig();
echo "path: " . $conf->getXbasePath() . "\n nombre: " . $conf->getXbaseName() . "\n";


$testDao = new ConnectionXbase($conf->getXbasePath(), $conf->getXbaseName());
$testDao->openDBF();
$num = $testDao->getRecordNumber();
echo "Numero: " . $num;
$data = array();
$data = $testDao->getDataArray($num);
//print_r($data);
foreach ($data as $key) {
    if($key['ID_PAIS'] == '97'){
	   //echo $key['ID_PAIS'] . "\n";
	   $keys = array_keys($key);
	   foreach($keys as $val){
	       echo $val . "\n";
	   }
    }
}
$testDao->closeDBF();



?>