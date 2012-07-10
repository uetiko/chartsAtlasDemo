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
    
    public function getUsuarioPostgres(){
        return $this->properties['base']['usuario'];
    }
    
    public function getPasswdPostgres(){
        return $this->properties['base']['passwd'];
    }
    
    public function getHostPostgres(){
        return $this->properties['base']['host'];
    }
    
    public function getPuertoPostgres(){
        return $this->properties['base']['puerto'];
    }
    
    public function getBasePostgres(){
        return $this->properties['base']['base'];
    }
}
?>