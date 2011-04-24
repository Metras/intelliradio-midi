<?php
require_once('../includes/include_db.inc');
require_once 'containers.php';
require_once '../includes/include_user.inc';
require_once('loginchecker.php');
/**
 * 
 * @desc Class to create request object for each request
 *
 * @author ramindu
 *
 */
class Request {
	/**
	 * 
	 * Name of container the requested track belongs to
	 * @var String
	 */
	var $container_name;
	/**
	 * 
	 * Id of requested track
	 * @var int
	 */
	var $track_id;
	var $track_name;
	/**
	 * 
	 * Container of the user who is making the request
	 * @var String
	 */
	var $user_container;
	/**
	 * 
	 * Initialize a request object
	 */
	function __construct($container_name, $track_id, $user_container) {
		$this->track_id = $track_id;
		$this->container_name = $container_name;
		$this->user_container = $user_container;
		$db = dbAccess::getInstance();
		$db->setQuery("SELECT filename FROM tracks WHERE id='{$this->track_id}'");
		$this->track_name = $db->loadResult();
	}
	/**
	 * 
	 * append latest request to relevant container playlist
	 */
	function appendRequest() {
		
	}
	/**
	 * 
	 * Send updated container playlist to server
	 */
	function sendRequest() {
		define(HOST,'192.168.1.6');
		define(PORT,2004);
		$timeout = 50;
		$request = $this->track_name.','.$this->user_container;
		$requestSocket = fsockopen(HOST,PORT,$errnum,$errstr,$timeout);
		if ( !is_resource($requestSocket) ) {
		    exit("Could not connect to send data to server! ".$errnum." ".$errstr);
		} else {
		    fputs($requestSocket, $request);
		}
		fclose($requestSocket);
		
	}
	/**
	 * 
	 * This is the function that gets called by the GUI
	 * @param $trackId int Id of the requested track
	 */
	function requestTrack($trackId) {
		
	}
}
if ( $_GET['container'] == 'all' ) {
	Container::getContainerTracks('default');
	echo '<br/>';
	Container::getContainerTracks('rock');
	echo '<br/>';
	Container::getContainerTracks('classical');
}
else if ( $_GET['container'] == 'rock' ) {
	Container::getContainerTracks('rock');
}
else if ( $_GET['container'] == 'classical' ) {
	Container::getContainerTracks('classical');
}
if ( $_GET['submitted'] ) {
	$db = dbAccess::getInstance();
	$requestedContainer = $_GET['container'];
	$user = unserialize($_SESSION['iuser']);
	$db->setQuery("SELECT container FROM track_requests WHERE user_id='{$user->id}'
					AND request_id = (SELECT MAX(request_id) FROM track_requests WHERE user_id='{$user->id}')");
	$lastReq = $db->loadResult();
	echo $lastReq;
	
	if ( $lastReq == $requestedContainer ) {
		$cnt = Container::getContainer($requestedContainer);
		$cnt->switchUserContainer($user);
		$user->container = $request->user_container = $requestedContainer;
		
	}
	$trackId = $_POST['track'];
	
	$request = new Request($requestedContainer, $trackId, $user->container);
	$request->sendRequest();
	$insertRequest = new stdClass(); 
	$insertRequest->request_id = '';
	$insertRequest->track_id = $request->track_id;
	$insertRequest->user_id = $user->id;
	$insertRequest->container = $request->container_name;
	$db->insertObject('track_requests', $insertRequest,'request_id');
	echo "<script type=\"text/javascript\">"
		 			."self.location='index.php';"
		 				."</script>";
}