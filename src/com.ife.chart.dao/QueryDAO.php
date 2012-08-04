<?php
include_once '../com.ife.chart.dao/Connection.php';
include_once '../com.ife.chart.config/DBConfig.php';

/**
 * Clase de DAO para consultas a la base de datos Postgres
 * @version 0.1
 * @author Angel Barrientos Cruz <uetiko@gmail.com>
 * @package com.ife.chart.dao
 * @license http://www.gnu.org/copyleft/lesser.html Distributed under the Lesser General Public License (LGPL)
 * @copyright 2012
 */
class QueryDAO{
	private $cnn;
    private $conf;
	function __construct() {
	    $this->conf = new DBConfig();
		$this->cnn = new Connection($this->conf->getUsuarioPostgres(), $this->conf->getPasswdPostgres(), $this->conf->getHostPostgres(), $this->conf->getPuertoPostgres(), $this->conf->getBasePostgres());
	}
    
    public function getLinks(){
        $this->cnn->openPersistentPgConnection();
        $data = array();
        $query = 'select nombre, link, "nombreCorto" from tbl_links';
        $result = pg_query($this->cnn->getPgConnection(), $query);
        while ($row = pg_fetch_array($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getMapas(){
        $array = array();
        $this->cnn->openPersistentPgConnection();
        $select = "select * from tbl_mapas";
        $result = pg_query($this->cnn->getPgConnection(), $select);
        while ($row = pg_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }
}

?>