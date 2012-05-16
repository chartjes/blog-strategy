<?php

// Logging class that uses the strategy pattern
require_once 'LoggingException.php';

class LoggerStrategy
{
	public function logMessage($message = "CRITICAL::The system encountered a problem")
	{
		$parts = explode('::', $message);
		$level = strtolower($parts[0]);
		$method = sprintf('_log%sMessage', ucfirst($level));

		if (!method_exists($this, $method)) {
			throw new LoggingException('Unknown logging level ' . $level);
		}

		return $this->$method($parts[1]);
	}	

	protected function _logNoticeMessage($message)
	{
		return $this->_writeToLog('notice', $message);
	}

	protected function _logCriticalMessage($message)
	{
		$this->_writeToLog('critical', $message);
		return $this->_emailOps($message);	
	}

	protected function _logCatastropheMessage($message)
	{
		$this->_writeToLog('catastrophe', $message);
		$this->_emailOps($message);
		return $this->_textCeo($message);
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