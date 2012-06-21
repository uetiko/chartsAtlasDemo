<?php
include '../com.ife.chart.action/PeticionAction.php';

$cgi = new PeticionAction();
if(!empty($_POST['peticion'])){
    switch ($_POST['action']) {
        case 'getPais':
            echo $cgi->executeGetPais();
            break;
        case 'getData':
            echo $cgi->executePaisData($_POST['idPais']);
            break;
        
        default:
            
            break;
    }
}

?>