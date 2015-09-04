<?php
$subfolder = "data/"; 
define('PTG_URL',$_SERVER['HTTP_HOST'] );
define('PTG_DIR',$_SERVER['DOCUMENT_ROOT'] );
$hostinfo = explode('.',$_SERVER['HTTP_HOST']); 
define('PTG_ROOT',$hostinfo[1].".".$hostinfo[2]);

# available languages
$langs = array(
        'en', //default
        'de',
);
asort($langs);

$lang = $_GET["lang"];
switch($lang){
	case 'de':
		include (PTG_DIR . 'lang/de.php');
		break;
	case 'en':
		include (PTG_DIR . 'lang/en.php');
		break;
	default: // 'en'
		include (PTG_DIR . 'lang/en.php');
		$lang = 'en';
}

include($subfolder . 'data.php');
$mode = "default";
if(!isset($PTG_keys_maxlen)){ // if not set by user
	$PTG_keys_maxlen = 0;
	foreach($PTG_galleries as $key => $value){
		$PTG_keys_maxlen += strlen($PTG_galleries[$key]["key"]);
	}
	$PTG_keys_maxlen = $PTG_keys_maxlen*1.1; // may be a little bit longer to allow random bits
}
$acc = ($PTG_keys_maxlen>0 ? substr($_GET["acc"],0,$PTG_keys_maxlen) : $_GET["acc"]); // poor savety to prevent long random 2000-character attacs
if($_GET["admin"] == "getallaccesscodes" && $_GET["mkey"] == $PTG_masterkey){
	$mode = "admin_allcodes";
	$masterkey = '';
	foreach($PTG_galleries as $key => $value){
		$masterkey .= $PTG_galleries[$key]["key"];
	}
	$acc = $masterkey;
}

$linkstr = "lang=" . $lang . "&acc=" . $acc;
$count_galleries = 0;
$first_t = '';
foreach($PTG_galleries as $key => $value){
	if(strpos($acc, $value["key"]) !== false){
		$count_galleries = $count_galleries + 1;
		if($first_t == ''){
			$first_t = $key;
		}
		$PTG_galleries[$key]["access"] = 1;
		if($_GET["t"] == $key){
			$mode = $key;
			if(is_numeric($_GET["f"])){
				sendFile($subfolder . $PTG_galleries[$mode]["folder"], $_GET["f"]);
			}
		}
	}
}
if($_GET["t"] == 'help'){
	$mode = 'default';
}else if($_GET["t"] == "disclaimer") {
	$mode = "disclaimer";
}else{
	if($mode == 'default' && $count_galleries == 1) $mode = $first_t;
}

# Set extra copyright, empty by default
$PTG_extra_copyright = ''

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $PTG_lng['xml-lang']; ?>" lang="<?php echo $PTG_lng['lang']; ?>">  
<head><title><?php echo $PTG_lng['title']; ?></title>
<link rel='stylesheet' type='text/css' href='template/master.css'/>
<meta http-equiv='Content-type' content='text/html; charset=utf-8' />
</head><body><div class='page_margins'><div class='page'>
<div id='main'><div id='col1'><div id='col1_content' class='clearfix'>
<div id='menubar'><span class='corners-top'><span></span></span>
	<?php /**************** MENU ****************/ ?>
	<p></p>
	<div class='caption'><?php echo $PTG_lng['title']; ?><div class="right">
		<?php
			$lngctr = 1;
			foreach($langs as $val){
				if($lngctr > 1){
					echo " | ";
				}
				if($val != $lang){
					echo '<a href="?lang='.$val.'&acc='.$acc .'">'.$val.'</a>';
				}else{
					echo $val;
				}
				$lngctr = $lngctr + 1;
			}		
		?>
	</div></div>
	<ul class='links'>
		<?php 
		echo("<li><a href='?".$linkstr."&t=help'>".$PTG_lng['title_home']."</a></li>
		<br />");
		
		$counter = 0;
		foreach($PTG_galleries as $key => $value){
			if($value["access"] > 0){
				echo("<li><a href='?".$linkstr."&t=". $key . "'>". $value["title"] ."</a></li>");		
				$counter++;
			}
		}
		if($counter == 0) echo($PTG_lng['error_key']);
		?>
	</ul>
	
	<div class='caption'><?php echo $PTG_lng['more_title'];  ?></div>
	<ul class='links'>
		<li><a href='http://vfalkenhahn.de' target='_blank'><?php echo $PTG_lng['more_vfalkenhahn'];  ?></a></li>
	</ul>
	
	
<span class='corners-bottom'><span></span></span></div></div></div>
<div id='col3'><div id='col3_content' class='clearfix'>
<div id='content'><span class='corners-top'><span></span></span>
<?php /**************** CONTENT ****************/

if($mode == "admin_allcodes"){
	echo "<h1 class='heading'>".$PTG_lng['admin_allcodes']."</h1><p>
	<table><colgroup>
		<col width='200'>
		<col width='100'>
    </colgroup>";
	foreach($PTG_galleries as $key => $value){
		echo("<tr><td>" . $PTG_galleries[$key]["title"] ."</td><td>". $PTG_galleries[$key]["key"] . "</td></tr>");
	}
	echo("</table></p><br/>");
}
if($mode != "default" && $mode != "disclaimer" && $mode != "admin_allcodes"){
	echo("<h1 class='heading'>" . $PTG_lng['title_piclist'] . " " . $PTG_galleries[$mode]["title"] . "</h1>");
	echo("<p>");
	if($PTG_galleries[$mode]["pass"] == ""){
		echo($PTG_lng['nopass'] . " ");
	}else{
		echo($PTG_lng['pass_hint'] . " <u>" . $PTG_galleries[$mode]["pass"] . "</u>. ");
	}
	echo($PTG_lng['help_pre'] . " <a href='?".$linkstr."&t=help'>".$PTG_lng['help_lnk']."</a> ".$PTG_lng['help_post']."</p>");
			
	$files = getFiles($subfolder . $PTG_galleries[$mode]["folder"]);
	if($files === FALSE){
		echo("<p>" . $PTG_lng['fatal'] . "</p>");
	}else if(empty($files)){
		echo("<p>" . $PTG_lng['error_files'] . "</p>");
	}else{
		echo("<ul class='bord'>");
		foreach ($files as $id => $file){
			echo("<li><a href='?".$linkstr."&t=".$mode."&f=".$id."'>". $file['name']. "</a> [". formatBytes($file['size']) ."]</li>");
		}
	}
	
}else if($mode == "disclaimer"){
	echo("<h1 class='heading'>".$PTG_lng['title_disclaimer']."</h1> 
		<p>".$PTG_lng['disclaimer']." <a href='?".$linkstr."'>".$PTG_lng['back']."</a></p>");
}else if($mode == "default"){

?>
<h1 class='heading'><?php echo $PTG_lng['title_home']; ?></h1><?php echo $PTG_lng['long_help_text']; ?>
<?php
}

echo("<div class='hspacer'>&nbsp;</div><span class='corners-bottom'><span></span></span></div></div>");
?>
<div id='ie_clearing'> &#160; </div></div></div>
<div id='footer'><span class='corners-top'><span></span></span>
&copy; <?php echo date('Y'); ?> by <a href="http://<?php $cr = (strlen($PTG_extra_copyright) > 0 ? $PTG_extra_copyright : $PTG_lng['vfalkenhahn']); echo $cr;?>"><?php echo $cr;?></a> &ndash; <?php echo("<a href='?".$linkstr."&t=disclaimer'>" . $PTG_lng['title_disclaimer'] . "</a>"); ?>
<span class='corners-bottom'><span></span></span></div>
<div class='hspacer'>&nbsp;</div>
</div></div></body></html>
<?


function getFiles($relpath){
	if(is_dir($relpath)){
		$files = array();
		$abspath = PTG_DIR ."/". $relpath;
		
		$hndlProcessingDir = opendir($relpath);			
		if($hndlProcessingDir) {
			while(($strFile = readdir($hndlProcessingDir)) != False) {
				if(file_exists($relpath ."/". $strFile)){
					if($strFile != "." and $strFile != ".." and $strFile != ".htaccess" and filetype($abspath."/".$strFile) != "dir" and strpos($strFile, ".bak") === false) {
						array_push($files, array('name' => $strFile, 'size' => filesize($abspath ."/". $strFile)));
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
	
	$strFilepath = PTG_DIR ."/". $relpath ."/". $filename;
	
	//$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
	//$mime = finfo_file($finfo, $strFilepath);
	//finfo_close($finfo);

	if(file_exists($strFilepath)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application); //'.$mime);
		header('Content-Disposition: attachment; filename="'.$filename.'"');
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

/*
  determine which language out of an available set the user prefers most
 
  $available_languages        	array with language-tag-strings (must be lowercase) that are available
  $http_accept_language    		a HTTP_ACCEPT_LANGUAGE string (read from $_SERVER['HTTP_ACCEPT_LANGUAGE'] if left out)
*/
function prefered_language ($available_languages,$http_accept_language="auto") {
    // if $http_accept_language was left out, read it from the HTTP-Header
    if ($http_accept_language == "auto") $http_accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

    // standard  for HTTP_ACCEPT_LANGUAGE is defined under
    // http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.4
    // pattern to find is therefore something like this:
    //    1#( language-range [ ";" "q" "=" qvalue ] )
    // where:
    //    language-range  = ( ( 1*8ALPHA *( "-" 1*8ALPHA ) ) | "*" )
    //    qvalue         = ( "0" [ "." 0*3DIGIT ] )
    //            | ( "1" [ "." 0*3("0") ] )
    preg_match_all("/([[:alpha:]]{1,8})(-([[:alpha:]|-]{1,8}))?" .
                   "(\s*;\s*q\s*=\s*(1\.0{0,3}|0\.\d{0,3}))?\s*(,|$)/i",
                   $http_accept_language, $hits, PREG_SET_ORDER);

    // default language (in case of no hits) is the first in the array
    $bestlang = $available_languages[0];
    $bestqval = 0;

    foreach ($hits as $arr) {
        // read data from the array of this hit
        $langprefix = strtolower ($arr[1]);
        if (!empty($arr[3])) {
            $langrange = strtolower ($arr[3]);
            $language = $langprefix . "-" . $langrange;
        }
        else $language = $langprefix;
        $qvalue = 1.0;
        if (!empty($arr[5])) $qvalue = floatval($arr[5]);
     
        // find q-maximal language 
        if (in_array($language,$available_languages) && ($qvalue > $bestqval)) {
            $bestlang = $language;
            $bestqval = $qvalue;
        }
        // if no direct hit, try the prefix only but decrease q-value by 10% (as http_negotiate_language does)
        else if (in_array($languageprefix,$available_languages) && (($qvalue*0.9) > $bestqval)) {
            $bestlang = $languageprefix;
            $bestqval = $qvalue*0.9;
        }
    }
    return $bestlang;
}
?>
