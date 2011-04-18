<?php
/**
 * User class for IntelliRadio frontend
 * @author Ramindu Deshapriya
 */
class User {
	var $userId;
	var $userName;
	/*
	 * Container the user belongs to
	 */
	var $container;
	/*
	 * Boolean value to check whether user is logged in
	 */
	var $loggedIn;
	/**
	 * 
	 * Instantiates a new User object
	 * @param $userId int ID of the user
	 * @param $userName String the username
	 * @param $container int user group id (based on user container)
	 */
	static function instantiateUser($userId, $userName, $container) {
		$user = new User();
		$user->userId = $userId;
		$user->userName = $userName;
		$user->container = $container;
		return $user;
	}
	
}