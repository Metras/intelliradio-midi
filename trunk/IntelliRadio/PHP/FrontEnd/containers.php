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
		$db->setQuery("SELECT id FROM containers WHERE name = '{$name}'"); 
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
		$db->setQuery("SELECT id FROM users WHERE container = '{$this->name}'");
		$users = $db->loadResultArray();
		return $users;
	}
	/**
	 * 
	 * Function to switch a given user's container
	 * @param $user User User object to switch to the container
	 * @return Boolean whether the user switch was successful
	 */
	function switchUserContainer($user) {
		$user->container = $this->name;
		$db = dbAccess::getInstance();
		/*$userToDb = new stdClass();
		$userToDb->id = $user->id;
		$userToDb->name = $user->name;
		$userToDb->container = $user->container;
		$userToDb->user_ip = $user->user_ip;
		$db->updateObject('users', $userToDb, 'id');*/
		$db->setQuery("UPDATE users SET container='{$this->name}' WHERE id='{$user->id}'");
		$ret = $db->loadResult();
		$db->setQuery("UPDATE containers SET current_users=current_users+1 WHERE id='{$this->id}'");
		return $db->loadResult();
	}
	/**
	 * 
	 * Takes a container name and loads the names of the tracks in the container as an array
	 * @param String $container name of the container which needs to be checked
	 */
	static function getContainerTracks($container = 'default') {
		$db = dbAccess::getInstance();
		$db->setQuery("SELECT id,name,artist FROM tracks where container='{$container}'");
		$tracks = $db->loadAssocList();
		if ( $tracks[0]['id'] == '' ) {
			echo '<p>Sorry, currently, the '.strtoupper($container).' container is empty.</p>';
		}
		else {
			echo "<div border=\"1\">" 
				."<table width=\"90%\" border=\"0\" style=\"border:0px\">"
				."<form name=\"requestForm\" method=\"POST\" action=\"index.php?page=request&submitted=true&container=".$container."\">";
			foreach($tracks as $t) {
				echo "<tr><td>".$t['name']." - ".$t['artist']."</td><td><input type=\"radio\" name=\"track\" value=\"".$t['id']."\"></td></tr>";
			}
			echo "<tr><td colspan=\"2\"><input type=\"submit\" value=\"Request\" /></td></tr>";
			echo "</form></table></div>";
		}
		
	}
	
	
}