<?php
/**
 * @name dbAccess
 * @package IntelliRadio.dbAccess
 * @author Ramindu Deshapriya
 * 
 * Class to handle database connections
 */
public class dbAccess {
	private __construct($host,$user,$password,$db) {
		if ( !@mysql_connect($host,$user,$password,true) ) {
			 
			
		}
		
		
	}
}