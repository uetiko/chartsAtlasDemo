<?php
include_once '../com.ife.chart.lib/spyc/spyc.php';

/**
 * 
 */
class DBConfig{
	private $properties;
	function __construct() {
		$this->properties = Spyc::YAMLLoad('../com.ife.chart.config/DBConfig.yaml');
	}
    
    public function getXbasePath(){
        return $this->properties['xbase']['path'];
    }
    
    public function getXbaseName(){
        return $this->properties['xbase']['name'];
    }
}

?>