<?php

// PHPUnit test for logger-switch.php

require '../logger-switch.php';

class LoggerSwitchTest extends PHPUnit_Framework_TestCase
{
	public $logger;

	public function setUp()
	{
		$this->logger = new LoggerSwitch();
	}
	
	/**
	 * Data provider for testing our logging object
	 */
	public function loggerTestingScenarios() 
	{
		return array(
			array(
				'NOTICE::test notice message',
				'Wrote test notice message to notice file'
			),
			array(
				'CRITICAL::test notice message',
				'Sent email to Ops'
			),
			array(
				'CATASTROPHE::test notice message',
				'Sent text to CEO'
			),
		);
	}

	/**
	 * @test
	 * @dataProvider loggerTestingScenarios
	 * @param $message          string
	 * @param $expectedResponse string
	 */
	public function testReturnsExpectedResponseBasedOnMessage(
		$message,
		$expectedResponse)
	{
		$response = $this->logger->logMessage($message);
		$this->assertEquals(
			$expectedResponse,
			$response,
			'Did not get expected response'
		);
	}

	/**
	 * @test
	 */ 
	public function testThrowsExceptionWhenUnknownLevelSubmitted()
	{
		$this->setExpectedException('LoggingException', 'Unknown logging level test');
		$response = $this->logger->logMessage('TEST:: test message');
	}
}