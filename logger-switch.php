<?php

// Sample logger class that uses a switch-case
require_once 'LoggingException.php';

class LoggerSwitch
{
	public function logMessage($message = "CRITICAL::The system encountered a problem")
	{
		$parts = explode('::', $message);
		$level = strtolower($parts[0]);
		$logMessage = $parts[1];

		switch ($level) {
			case 'notice':
				return $this->_writeToLog($level, $logMessage);
			case 'critical':
				$this->_writeToLog($level, $logMessage);
				return $this->_emailOps($message);
			case 'catastrophe':
				$this->_writeToLog($level, $logMessage);
				$this->_emailOps($logMessage);
				return $this->_textCeo($message);
		}

		throw new LoggingException("Unknown logging level {$level}");
	}

	protected function _writeToLog($level, $logMessage)
	{
		return "Wrote {$logMessage} to {$level} file";
	}

	protected function _emailOps($logMessage)
	{
		return "Sent email to Ops";
	}

	protected function _textCeo($message)
	{
		return "Sent text to CEO";
	}
}