<?php
/**
 * 
 * Patented MIDI Include function
 * @param $name String name of the page (as given by GET request)
 * @param $namesAndPages Array array of names for pages and their mapping for PHP files
 */
function midiInclude($name, $namesAndPages) {
	include($namesAndPages[$name]);
}
function login() {
	if($_GET['loginAttempt']==true) {
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$db = dbAccess::getInstance();
		$db->setQuery("SELECT id,password,container FROM users WHERE name='{$username}'");
		if ( is_null($result = $db->loadAssoc()) ) {
			echo print_r($db);
			echo '<p>Error: Username does not exist</p>';
		}
		else {
			if ( $result['password'] != $password ) {
				echo '<p>Error: Incorrect password.</p>';
			}
			else {
				$user = User::instantiateUser($result['id'], $username, $result['container'], $_SERVER['REMOTE_ADDR']);
				$_SESSION['iuser'] = serialize($user);
				//echo $_SESSION['iuser']->name;
				echo '<p>Welcome back, '.$user->name.' Click here to '.LOGOUT_LINK.'</p>';
				echo "<script type=\"text/javascript\">"
		 			."self.location='index.php';"
		 				."</script>";
			}
		}
	   
	}
}