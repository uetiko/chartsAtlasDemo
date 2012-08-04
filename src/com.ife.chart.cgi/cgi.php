<?php
include '../com.ife.chart.action/PeticionAction.php';
include '../com.ife.chart.action/DashboardAction.php';

$cgi = new PeticionAction();
if(!empty($_POST['peticion'])){
    switch ($_POST['action']) {
        case 'getPais':
            echo $cgi->executeGetPais();
            break;
        case 'getData':
            echo $cgi->executePaisData($_POST['idPais']);
            break;
        case 'getFecha':
            echo $cgi->executeGetFecha();
            break;
        case 'mapGuide':
            echo $cgi->executeMapLink();
            break;
        case 'getMapas':
            $dash = new DashboardAction();
            echo $dash->executeGetMapas();
            break;
        default:
            break;
    }
}

?>