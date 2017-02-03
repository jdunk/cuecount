<?php

if (!function_exists('jdlog')) {
	function jdlog($str) {
		if (!is_string($str)) {
			ob_start();
			var_dump($str);
			$str = ob_get_clean();
		}
		file_put_contents(__DIR__ . '/../jared.log', '[' . date('c') . "] $str\n", FILE_APPEND);
	}
}

if (empty($GLOBALS['conn3'])) {
	$GLOBALS['conn3'] = mysqli_connect(
		env('DB_HOST', 'localhost'),
		env('DB_USERNAME', 'root'),
		env('DB_PASSWORD', 'secret'),
		env('DB_DATABASE', 'app')
	)
	or die('error connecting to database');
}

$conn3 = $GLOBALS['conn3'];
