<?php if(!defined('TTPDS_DIR')){ header("Location: http://".$_SERVER['HTTP_HOST']); exit; }

function getarg($argkey) {
	return getargfrom($argkey,filter_url($_GET));
}

function getargfrom($argkey,$fromvar) {
	$argval = (isset($fromvar[$argkey]) ? $fromvar[$argkey] : "");
	return $argval;
}

# http://stackoverflow.com/questions/1885979/php-get-variable-array-injection
function filter_url($url){
	if (is_array($url)){
		foreach ($url as $key => $value){
			// recurssion
			$url[$key] = filter_url($value);
		}
		return $url;
	}else{
		// remove everything except for a-ZA-Z0-9_.-&=
		$url = preg_replace('/[^a-ZA-Z0-9_\.\-&=]/', '', $url);
		return $url;
	}
}

?>
