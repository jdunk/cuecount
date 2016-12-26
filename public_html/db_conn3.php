<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_reporting', -1);
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
	$GLOBALS['conn3'] = mysqli_connect("localhost","cuecount_db_user","cuecount123$","cuecount") or die('error connecting to database');
}

$conn3 = $GLOBALS['conn3'];
