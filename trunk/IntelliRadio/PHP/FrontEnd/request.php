<?php
require_once('../includes/include_db.inc');
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
	 * Initialize a request object
	 */
	function __construct($container_name, $track_id) {
		$this->track_id = $track_id;
		$this->container_name = $container_name;
		$db = dbAccess::getInstance();
		$db->setQuery("SELECT name FROM tracks WHERE id='{$this->track_id}'");
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
		define(HOST, '192.168.1.1');
		define(PORT, '3998');
		
		set_time_limit(0);
		$requestStream = $this->container_name.','.$this->track_name;
		if ( !$requestSocket = socket_create(AF_INET, SOCK_STREAM, 0) ) {
			echo '<p>Error: Could not create socket!</p>';
		} 
		if ( !socket_bind($socket, HOST, PORT) ) {
			echo '<p>Error: Could not bind to port!</p>';
		}
		if ( !socket_write($requestSocket, $requestStream, strlen ($requestStream))) {
			echo '<p>Error: Could not write request to socket!</p>';
		}

		socket_close($requestSocket);
	}
	/**
	 * 
	 * This is the function that gets called by the GUI
	 * @param $trackId int Id of the requested track
	 */
	function requestTrack($trackId) {
		
	}
}