<?php
/**
 * User class for IntelliRadio frontend
 * @author Ramindu Deshapriya
 */
class User {
	var $id;
	var $name;
	/**
	 * 
	 * Container the user belongs to
	 * @var String
	 */
	var $container;
	/**
	 * IP address the user logged in from
	 */
	var $user_ip;
	/**
	 * 
	 * Whether the user is logged in or not
	 * @var Boolean
	 */
	var $loggedIn;
	/**
	 * 
	 * @desc Instantiates a new User object
	 * @param $userId int ID of the user
	 * @param $userName String the username
	 * @param $container int user group id (based on user container)
	 */
	static function instantiateUser($userId, $userName, $container,$ip) {
		$user = new User();
		$user->id = $userId;
		$user->name = $userName;
		$user->container = $container;
		$user->user_ip = $ip;
		$user->loggedIn = true;
		return $user;
	}
	/**
	 * 
	 * @desc Function to switch the user from current container to a specified container
	 * @param $container [optional]String name of the container the user needs to be switched to
	 */
	function switchContainer($container = 'default') {
		$this->container = $container;
		$userToDb = new stdClass();
		$userToDb->id = $this->id;
		$userToDb->name = $this->name;
		$userToDb->password = $this->password;
		$userToDb->container = $container;
		$userToDb->user_ip = $this->user_ip;
		dbAccess::getInstance()->updateObject('users', $userToDb, 'id');
		
	}
	
}