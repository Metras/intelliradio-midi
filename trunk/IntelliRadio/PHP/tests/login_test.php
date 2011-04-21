<?php
if ( !defined(SIMPLE_TEST) ) {
	define(SIMPLE_TEST,'../simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');

class LoginTest extends UnitTestCase {
	function LoginTest() {
		$this->UnitTestCase();
	}
	function testLogin() {
		
	}
}