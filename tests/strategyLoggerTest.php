<?php

// PHPUnit test for logger-switch.php

require '../logger-strategy.php';

class LoggerStrategyTest extends PHPUnit_Framework_TestCase
{
	public $logger;

	public function setUp()
	{
		$this->logger = new LoggerStrategy();
	}
	
	/**
	 * @test
	 */
	public function testNotice()
	{
		$message = 'NOTICE::test notice message';
		$expectedResponse = "Wrote test notice message to notice file";
		$response = $this->logger->logMessage($message);
		$this->assertEquals(
			$expectedResponse,
			$response,
			'Did not get expected notice-level message'
		);
	}

	/**
	 * @test
	 */
	public function testCritical()
	{
		$message = 'CRITICAL::test notice message';
		$expectedResponse = "Sent email to Ops";
		$response = $this->logger->logMessage($message);
		$this->assertEquals(
			$expectedResponse,
			$response,
			'Did not get expected critical-level message'
		);
	}

	/**
	 * @test
	 */
	public function testCatastrophe()
	{
		$message = 'CATASTROPHE::test catastrophe message';
		$expectedResponse = "Sent text to CEO";
		$response = $this->logger->logMessage($message);
		$this->assertEquals(
			$expectedResponse,
			$response,
			'Did not get expected catastrophe level message'
		);
	}

	/**
	 * @test
	 */ 
	public function testThrowsExceptionWhenUnknownLevelSubmitted()
	{
		$this->setExpectedException('LoggingException', 'Unknown logging level test');
		$response = $this->logger->logMessage('TEST::test message');
	}

}