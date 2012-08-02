<?php
include_once '../com.ife.chart.action/PeticionAction.php';
include_once '../com.ife.chart.action/DashboardAction.php';

$action = new PeticionAction();
$act = new DashboardAction();
echo $action->executeGetPais() . "\n\n\n\n\n\n\n\n";
echo $action->executePaisData('29') . "\n\n\n\n\n";
echo $action->executeMapLink() . "\n";

echo $act->executeGrafica() . "\n\n\n";
?>