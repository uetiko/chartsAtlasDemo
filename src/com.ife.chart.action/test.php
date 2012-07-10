<?php
include_once '../com.ife.chart.action/PeticionAction.php';

$action = new PeticionAction();
echo $action->executeGetPais() . "\n\n\n\n\n\n\n\n";
echo $action->executePaisData('29') . "\n\n\n\n\n";
echo $action->executeMapLink() . "\n";
?>