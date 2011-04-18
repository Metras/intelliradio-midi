<?php
/**
 * Container management for IntelliRadio
 * @author Ramindu
 * @license GPL v3
 */
require_once('../includes/include_all.inc');
class Container {
	/*
	 * Returns a container object
	 */
	static function getContainer() {
		return new self(); 
	}
	
}