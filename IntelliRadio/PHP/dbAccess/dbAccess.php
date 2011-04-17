<?php
/**
 * @name dbAccess
 * @package IntelliRadio.dbAccess
 * @author Ramindu Deshapriya
 * 
 * Class to handle database connections
 */
class dbAccess {
	var _connection; 
	private __construct($host,$user,$password,$db) {
		if ( !($this->_connection = @mysql_connect($host,$user,$password,true)) ) {
			die('Unable to connect to database, recheck your DB server');	 
		}
		
		
	}
}