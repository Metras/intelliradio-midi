<?php
require_once '../includes/include_db.inc';
if ( !defined(SIMPLE_TEST) ) {
	define(SIMPLE_TEST,'../simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');

class dbAccessTest extends UnitTestCase {
	function dbAccessTest() {
		$this->UnitTestCase('Database Access test');
	}
	function testDbAccess() {
		$this->assertIsA($db = dbAccess::getInstance(), 'dbAccess');
		print_r($db);
	}
}
$test = &new dbAccessTest();
$test->run(new HtmlReporter());