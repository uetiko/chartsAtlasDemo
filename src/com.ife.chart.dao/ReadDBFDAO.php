<?php
include '../com.ife.chart.dao/ConnectionXbase.php';
include_once '../com.ife.chart.config/DBConfig.php';

/**
 * 
 */
class ReadDBFDAO{
	private $dbf;
    private $conf;
	function __construct() {
		$this->conf = new DBConfig();
        $this->dbf = new ConnectionXbase($this->conf->getXbasePath(), $this->conf->getXbaseName());
	}
    
    /**
     * @return array
     */
    public function getDataDbf(){
        $data = array();
        $this->dbf->openDBF();
        $num = $this->dbf->getRecordNumber();
        $data = $this->dbf->getDataArray($num);
        $this->dbf->closeDBF();
        return $data;
    }
}


?>