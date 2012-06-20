<?php
include_once '../com.ife.chart.config/DBConfig.php';

/**
 * 
 */
class ConnectionXbase{
	private $path;
    private $name;
    private $xdb;
    private $headers;
	function __construct($path, $name) {
		$this->path = $path;
        $this->name = $name;
	}
    
    public function openDBF(){
        $this->xdb = dbase_open($this->path . $this->name . '.dbf', 0);
        if($this->xdb){
            return $this->xdb;
        }else{
            return FALSE;
        }
    }
    
    public function closeDBF(){
        if(dbase_close($this->xdb) == FALSE){
            //error al logger
        }
    }
    
    public function getHeadersDBF(){
        $this->headers = dbase_get_record_with_names($identifier, $record);
    }
    
    public function getRecordNumber(){
        return dbase_numrecords($this->xdb);
    }
    
    public function getDataArray($number){
        $array = array();
        for($i = 0; $i <= $number; $i++){
            $array[] = dbase_get_record_with_names($this->xdb, $i);
        }
        return $array;
    }
    
}