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
		$db->setQuery('SELECT '.$db->nameQuote('id').' FROM '.$db->nameQuote('containers')
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
		$db = dbAccess::getInstance();
		$db->setQuery('SELECT id FROM users WHERE container = '.$this->name);
		$users = $db->loadResultArray();
		return $users;
	}
	/**
	 * 
	 * Function to switch a given user's container
	 * @param $user User User object to switch to the container
	 * @return Boolean whether the user switch was successful
	 */
	function switchUserContainter($user) {
		$user->container = $this->name;
		$db = dbAccess::getInstance();
		$userToDb = new stdClass();
		$userToDb->id = $user->id;
		$userToDb->name = $user->name;
		$userToDb->container = $user->container;
		$userToDb->user_ip = $user->user_ip;
		$db->updateObject('users', $userToDb, 'id');
		$db->setQuery('UPDATE containers SET current_users=current_users+1 WHERE id='.$this->id);
		return $db->loadResult();
	}
	
	
}