<?php

namespace Core;

class Error {

	public static function errorHandler($level, $msg, $file, $line) {
		if (error_reporting() !== 0) {
			throw new \ErrorException($msg, 0, $level, $file, $line);
		}
	}

	public static function exceptionHandler($e) {
		if ($e->getCode() === 404) http_response_code(404);
		else http_response_code(500);

		$error_message = '<h1>Fatal Error: </h1>';
		$error_message .= '<p>Uncaught exception: "' . get_class($e) . '"</p>';
		$error_message .= '<p>Message: "' . $e->getMessage() . '"</p>';
		$error_message .= '<p>Stack Trace: <pre>' . $e->getTraceAsString() . '</pre></p>';
		$error_message .= '<p>Thrown in "' . $e->getFile() . '" on line "' . $e->getLine() . '"';

		echo $error_message;
	}
}
