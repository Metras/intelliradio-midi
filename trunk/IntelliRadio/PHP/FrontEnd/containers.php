<?php
/**
 * Container management for IntelliRadio
 * @author Ramindu
 * @license GPL v3
 */
require_once('../includes/include_all.inc');
/**
 * 
 * @desc Container class: Instantiates and manages containers
 * @author ramindu
 *
 */
class Container {
	var $id = null;
	var $name = '';
	/**
	 * 
	 * constructor
	 * @param $id
	 * @param $name
	 */
	function __construct($id, $name) {
		$this->id = $id;
		$this->name = $name;
	}
	/**
	 * 
	 * Returns a Container object of a given type
	 * @param $name String name of the container that needs to be instantiated
	 */
	static function getContainer($name = 'default') {
		$db = dbAccess::getInstance();
		$db->setQuery('SELECT '.$db->nameQuote('container_id').' FROM '.$db->nameQuote('containers')
						.' WHERE '.$db->nameQuote('name').' = '.$name); 
		$id = $db->loadResult();
		return new Container($id, $name); 
	}
	
	/**
	 * 
	 * Gets the ids of users who belong to the container in question
	 * @return Array of userIds
	 */
	function getContainerUsers() {
		
	}
	
	
}