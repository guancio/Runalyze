<?php

require_once dirname(__FILE__) . '/../../../inc/system/class.Request.php';

/**
 * Test class for Request.
 * Generated by PHPUnit on 2012-03-11 at 12:05:26.
 */
class RequestTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var Request
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {}

	/**
	 * @covers Request::sendId
	 * @todo Implement testSendId().
	 */
	public function testSendId() {
		$this->assertEquals( Request::sendId(), false );

		$_GET['id'] = 27;
		$this->assertEquals( Request::sendId(), 27 );

		unset($_GET['id']);
		$_POST['id'] = 13;
		$this->assertEquals( Request::sendId(), 13 );
	}

}

?>
