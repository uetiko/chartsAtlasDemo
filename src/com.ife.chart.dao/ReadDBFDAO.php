<?php
include '../com.ife.chart.dao/ConnectionXbase.php';
include_once '../com.ife.chart.config/DBConfig.php';

/**
 *
 */
class ReadDBFDAO {
    private $dbf;
    private $conf;
    function __construct($name) {
        $this -> conf = new DBConfig();
        $this -> dbf = new ConnectionXbase($this -> conf -> getXbasePath(), $this -> conf -> getXbases($name));
    }

    /**
     * @return array
     */
    public function getDataDbf() {
        $data = array();
        try {
            $this -> dbf -> openDBF();
            $data = $this -> dbf -> getDataArray($this -> dbf -> getRecordNumber());
            $this -> dbf -> closeDBF();
        } catch(exception $e) {
            $e -> getTrace();
        }
        return $data;
    }

}
?>