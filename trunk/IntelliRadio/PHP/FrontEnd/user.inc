<?php
/**
 * User class for IntelliRadio frontend
 * @author Ramindu Deshapriya
 */
class User {
	var $userId;
	var $userName;
	var $userGroup;
	var $loggedIn;
	/**
	 * 
	 * Instantiates a new User object
	 * @param $userId int ID of the user
	 * @param $userName String the username
	 * @param $userGroup int user group id (based on user container)
	 */
	function instantiateUser($userId, $userName, $userGroup) {
		$user = new User();
		$user->userId = $userId;
		$user->userName = $userName;
		$user->userGroup = $userGroup;
		return $user;
	}
}