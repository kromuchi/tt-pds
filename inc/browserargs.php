<?php if(!defined('TTPDS_DIR')){ header("Location: http://".$_SERVER['HTTP_HOST']); exit; }

function getarg($argkey) {
	return getargfrom($argkey,$_GET);
}

function getargfrom($argkey,$fromvar) {
	$argval = (isset($fromvar[$argkey]) ? $fromvar[$argkey] : "");
	return $argval;
}

?>
