<?php
require_once('../includes/include_db.inc');
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
		define(HOST,'localhost');
		define(PORT,2004);
		$timeout = 50;
		$request = $this->track_name.','.$this->container_name;
		$requestSocket = fsockopen($host,$port,$errnum,$errstr,$timeout);
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