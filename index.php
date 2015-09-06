<?php
define('TTPDS_URL',$_SERVER['HTTP_HOST'] . (dirname($_SERVER['SCRIPT_NAME']) == "\\" ? "" : dirname($_SERVER['SCRIPT_NAME']))); // script url
define('TTPDS_DIR',$_SERVER['DOCUMENT_ROOT'] . (dirname($_SERVER['SCRIPT_NAME']) == "\\" ? "" : dirname($_SERVER['SCRIPT_NAME'])) );  // script directory
$hostinfo = explode('.',$_SERVER['HTTP_HOST']); 
define('TTPDS_ROOT',($hostinfo[0]=="localhost" ? $hostinfo[0] : $hostinfo[1].".".$hostinfo[2])); // root URL
if(!file_exists('./config.php')) die('faulty setup of tt-pds: https://github.com/kromuchi/tt-pds');
include(TTPDS_DIR . '/config.php'); 
include(TTPDS_DIR . '/inc/lang.php');
include(TTPDS_DIR . '/inc/files.php');
include(TTPDS_DIR . '/inc/browserargs.php');

asort($TTPDS_langs);
$lang = getarg("lang");
if($lang == "" || !in_array($lang, $TTPDS_langs)) $lang = prefered_language($TTPDS_langs);
switch($lang){
	case 'de':
		include (TTPDS_DIR . '/lang/de.php');
		break;
	case 'en':
		include (TTPDS_DIR . '/lang/en.php');
		break;
	default: // 'en'
		include (TTPDS_DIR . '/lang/en.php');
		$lang = 'en';
}

include($TTPDS_datafolder . '/' . 'data.php');
asort($TTPDS_galleries);
$mode = "default";
if(!isset($TTPDS_keys_maxlen)){ // if not set by user
	$TTPDS_keys_maxlen = 0;
	foreach($TTPDS_galleries as $key => $value){
		$TTPDS_keys_maxlen += strlen($TTPDS_galleries[$key]["key"]);
	}
	$TTPDS_keys_maxlen = $TTPDS_keys_maxlen*1.1; // may be a little bit longer to allow random bits
}
$acc = getarg("acc");
$acc = ($TTPDS_keys_maxlen>0 ? substr($acc,0,$TTPDS_keys_maxlen) : $acc); // poor savety to prevent long random 2000-character attacs
if(getarg("admin") == "getallaccesscodes" && getarg("mkey") == $TTPDS_masterkey){
	$mode = "admin_allcodes";
	$masterkey = '';
	foreach($TTPDS_galleries as $key => $value){
		$masterkey .= $TTPDS_galleries[$key]["key"];
	}
	$acc = $masterkey;
}

$linkstr = "lang=" . $lang . "&acc=" . $acc;
$count_galleries = 0;
$first_t = '';
$t = getarg('t');
foreach($TTPDS_galleries as $key => $value){
	if(strpos($acc, $value["key"]) !== false){
		$count_galleries = $count_galleries + 1;
		if($first_t == ''){
			$first_t = $key;
		}
		$TTPDS_galleries[$key]["access"] = 1;
		if($t == $key){
			$mode = $key;
			$f = getarg('f');
			if(is_numeric($f )){
				sendFile($TTPDS_datafolder . '/' . $TTPDS_galleries[$mode]["folder"], $f );
			}
		}
	}
}
if($t == 'help'){
	$mode = 'default';
}else if($t == "disclaimer") {
	$mode = "disclaimer";
}else{
	if($mode == 'default' && $count_galleries == 1) $mode = $first_t;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $TTPDS_lng['xml-lang']; ?>" lang="<?php echo $TTPDS_lng['lang']; ?>">
  
<head><title><?php echo $TTPDS_lng['title']; ?></title>
<link rel='stylesheet' type='text/css' href='template/master.css'/>
<meta http-equiv='Content-type' content='text/html; charset=utf-8' />
</head><body><div class='page_margins'><div class='page'>
<div id='main'><div id='col1'><div id='col1_content' class='clearfix'>
<div id='menubar'><span class='corners-top'><span></span></span>
	<?php /**************** MENU ****************/ ?>
	<p></p>
	<div class='caption'><?php echo $TTPDS_lng['title']; ?><div class="right">
		<?php
			$lngctr = 1;
			foreach($TTPDS_langs as $val){
				if($lngctr > 1){
					echo " | ";
				}
				if($val != $lang){
					echo '<a href="?lang=' . $val . '&acc=' . $acc . '">'.$val . '</a>';
				}else{
					echo $val;
				}
				$lngctr = $lngctr + 1;
			}
		?>
	</div></div>
	<ul class='links'>
		<?php 
		echo "<li><a href='?".$linkstr."&t=help'>".$TTPDS_lng['title_home']."</a></li><br/>";
		
		$counter = 0;
		foreach($TTPDS_galleries as $key => $value){
			if($value["access"] > 0){
				echo "<li><a href='?".$linkstr."&t=". $key . "'>". $value["title"] ."</a></li>";
				$counter++;
			}
		}
		if($counter == 0) echo($TTPDS_lng['error_key']);
		?>
	</ul>
	
	<div class='caption'><?php echo $TTPDS_lng['more_title']; ?></div>
	<ul class='links'>
		<li><a href='http://vfalkenhahn.de' target='_blank'><?php echo $TTPDS_lng['more_vfalkenhahn']; ?></a></li>
	</ul>
	
	
<span class='corners-bottom'><span></span></span></div></div></div>
<div id='col3'><div id='col3_content' class='clearfix'>
<div id='content'><span class='corners-top'><span></span></span>
<?php /**************** CONTENT ****************/

if($mode == "admin_allcodes"){
	echo "<h1 class='heading'>" . $TTPDS_lng['admin_allcodes'] . "</h1><p>
	<table><colgroup>
		<col width='200'>
		<col width='100'>
    </colgroup>";
	foreach($TTPDS_galleries as $key => $value){
		echo "<tr><td>" . $TTPDS_galleries[$key]["title"] . "</td><td>" . $TTPDS_galleries[$key]["key"] . "</td></tr>";
	}
	echo "</table></p><br/>";
}
if($mode != "default" && $mode != "disclaimer" && $mode != "admin_allcodes"){
	echo "<h1 class='heading'>" . $TTPDS_lng['title_piclist'] . " " . $TTPDS_galleries[$mode]["title"] . "</h1>";
	echo "<p>";
	if($TTPDS_galleries[$mode]["pass"] == ""){
		echo($TTPDS_lng['nopass'] . " ");
	}else{
		echo($TTPDS_lng['pass_hint'] . " <u>" . $TTPDS_galleries[$mode]["pass"] . "</u>. ");
	}
	echo $TTPDS_lng['help_pre'] . " <a href='?" . $linkstr."&t=help'>" . $TTPDS_lng['help_lnk'] . "</a> " . $TTPDS_lng['help_post'] .
 "</p>";
			
	$files = getFiles($TTPDS_datafolder . '/' . $TTPDS_galleries[$mode]["folder"]);
	if($files === FALSE){
		echo("<p>" . $TTPDS_lng['fatal'] . "</p>");
	}else if(empty($files)){
		echo("<p>" . $TTPDS_lng['error_files'] . "</p>");
	}else{
		echo("<ul class='bord'>");
		foreach ($files as $id => $file){
			echo("<li><a href='?" . $linkstr . "&t=" . $mode . "&f=" . $id . "'>" . $file['name'] . "</a> [" . formatBytes($file[
'size']) ."]</li>");
		}
	}
	
}else if($mode == "disclaimer"){
	echo "<h1 class='heading'>" . $TTPDS_lng['title_disclaimer'] . "</h1>" .
		"<p>" . $TTPDS_lng['disclaimer'] . " <a href='?" . $linkstr . "'>" . $TTPDS_lng['back'] . "</a></p>";
}else if($mode == "default"){

?>
<h1 class='heading'><?php echo $TTPDS_lng['title_home']; ?></h1><?php echo $TTPDS_lng['long_help_text']; ?>
<?php
}

echo("<div class='hspacer'>&nbsp;</div><span class='corners-bottom'><span></span></span></div></div>");
?>
<div id='ie_clearing'> &#160; </div></div></div>
<div id='footer'><span class='corners-top'><span></span></span>
&copy; <?php echo date('Y'); ?> by <a href="http://<?php $cr = (strlen($TTPDS_extra_copyright) > 0 ? $TTPDS_extra_copyright : 
TTPDS_ROOT); echo $cr; ?>"><?php echo $cr; ?></a> &ndash; <?php echo("<a href='?" . $linkstr . "&t=disclaimer'>" . $TTPDS_lng[
'title_disclaimer'] . "</a>"); ?>
<span class='corners-bottom'><span></span></span></div>
<div class='hspacer'>&nbsp;</div>
</div></div></body></html>
