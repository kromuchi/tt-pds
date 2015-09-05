<?php if(!defined('TTPDS_DIR')){ header("Location: http://".$_SERVER['HTTP_HOST']); exit; }

function getarg($argkey) {
	$argval = (isset($_GET[$argkey]) ? $_GET[$argkey] : "");
	return $argval;
}

?>
