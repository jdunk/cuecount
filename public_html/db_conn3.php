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
	$GLOBALS['conn3'] = mysqli_connect("localhost","cuecount_wp653","cuecount123$","cuecount_proto") or die ('error with database');
}

$conn3 = $GLOBALS['conn3'];
