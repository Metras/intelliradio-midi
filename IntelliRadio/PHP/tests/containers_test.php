<?php

require_once '../FrontEnd/containers.php';
if ( !defined(SIMPLE_TEST) ) {
	define(SIMPLE_TEST,'../simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');

class ContainerInstanceTest extends UnitTestCase {
	function ContainerInstanceTest() {
		$this->UnitTestCase('Container instantiation test');
	}
	function testContainerInstantiation() {
		$cnt = Container::getContainer();
		$this->assertIsA($cnt, 'Container', 'Testing with empty string');
		$cnt = Container::getContainer('rock');
		$this->assertIsA($cnt, 'Container', 'Testing with ROCK string');
	}
}
class getContainerTracksTest extends UnitTestCase {
	function getContainerTracksTest() {
		$this->UnitTestCase('Get Container Tracks test');
	}
	function testGetContainerTracks() {
		$this->assertTrue(Container::getContainerTracks());
		$this->assertTrue(Container::getContainerTracks('rock'));
	}
}
$test = &new ContainerInstanceTest();
$test->run(new HtmlReporter());
$test = &new getContainerTracksTest();
$test->run(new HtmlReporter());