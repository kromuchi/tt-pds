<?php if(!defined('TTPDS_DIR')){ header("Location: http://".$_SERVER['HTTP_HOST']); exit; }

function getFiles($relpath){
	if(is_dir($relpath)){
		$files = array();
		$abspath = TTPDS_DIR . $relpath;
		
		$hndlProcessingDir = opendir($relpath);			
		if($hndlProcessingDir) {
			while(($strFile = readdir($hndlProcessingDir)) != False) {
				if(file_exists($relpath . "/" . $strFile)){
					if($strFile != "." and $strFile != ".." and $strFile != ".htaccess" and filetype($abspath . "/" . $strFile) != "dir" and strpos($strFile, ".bak") === false) {
						array_push($files, array('name' => $strFile, 'size' => filesize($abspath . "/" . $strFile)));
					}
				}
			}
		}		
		closedir($hndlProcessingDir);
		sort($files);
		return($files);
	}
	return false;
}

function sendFile($relpath, $fileindex){
	$filelist = getFiles($relpath);
	$filename = $filelist[$fileindex]['name'];
	
	$strFilepath = TTPDS_DIR . $relpath . "/" . $filename;
	
	$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type extension
	$mime = finfo_file($finfo, $strFilepath);
	finfo_close($finfo);

	if(file_exists($strFilepath)) {
		header('Content-Description: File Transfer');
		header('Content-Type: ' . $mime);
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . $filelist[$fileindex]['size']);
		
		readfile($strFilepath);
	}
}

function formatBytes($bytes, $precision = 2) {
	$base = 1024; // 1000
	
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
  
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log($base));
    $pow = min($pow, count($units) - 1);
  
    $bytes /= pow($base, $pow);
  
    return round($bytes, $precision) . ' ' . $units[$pow];
} 

?>
