<?php
$parts = explode('/', dirname($_SERVER['SCRIPT_NAME']));
array_pop($parts);
$parentpath = implode('/', $parts);
$hostinfo = explode('.',$_SERVER['HTTP_HOST']); 
define('TTPDS_ROOT',($hostinfo[0]=="localhost" ? $hostinfo[0] : $hostinfo[1].".".$hostinfo[2])); // root URL
define('TTPDS_URL',$_SERVER['HTTP_HOST'] . $parentpath); // script url
define('TTPDS_DIR',$_SERVER['DOCUMENT_ROOT'] . $parentpath);  // script directory
include(TTPDS_DIR . '/config.php');
include(TTPDS_DIR . '/inc/lang.php');
include(TTPDS_DIR . '/inc/files.php');
include(TTPDS_DIR . '/inc/browserargs.php');

// Parsing arguments manually as $_GET is not working due to htaccess redirect
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$page_redirected_from = 'https://' .TTPDS_URL . substr($uri_parts[0],strlen($parentpath));
parse_str(isset($uri_parts[1]) ? $uri_parts[1] : "", $output_get);
$acc  = filter_url(getargfrom('acc', $output_get));
$lang = filter_url(getargfrom('lang',$output_get));

asort($TTPDS_langs);
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

# Get error code
switch (getenv("REDIRECT_STATUS")) {

	# "403 - Forbidden"
	case 403:
	$error_code = "403 Forbidden";
	$explanation = $TTPDS_lng['error_403'];
	break;

	# "404 - Not Found"
	case 404:
	$error_code = "404 Not Found";
	$explanation = $TTPDS_lng['error_404'];
	break;
	
	# "500 - Internal Server Error" //default
	case 500:
	$error_code = "500 Internal Server Error";
	$explanation = $TTPDS_lng['error_500'];
	break;
	
	default:
	$error_code = "500 Internal Server Error";
	$explanation = $TTPDS_lng['error_500'];
}

$acc = ($TTPDS_keys_maxlen>0 ? substr($acc,0,$TTPDS_keys_maxlen) : $acc); // poor savety to prevent long random 2000-character attacs

$linkstr = "lang=" . $lang . "&acc=" . $acc;

# Send error header
header($_SERVER["SERVER_PROTOCOL"] . ' ' . $error_code);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $TTPDS_lng['xml-lang']; ?>" lang="<?php echo $TTPDS_lng['lang']; ?>">
  
<head>
<title><?php echo $error_code; ?></title>
<link rel='stylesheet' type='text/css' href='<?php echo ('https://' . TTPDS_URL . '/template/master.css'); ?>'/>
<meta http-equiv='Content-type' content='text/html; charset=utf-8' />
</head>
<body>
<div class='page_margins'><div class='page'>
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
		echo('<li><a href="https://' . TTPDS_URL . "?" . $linkstr.'&t=help">' . $TTPDS_lng['title_home'] . "</a></li>
		<br />");
		?>
	</ul>
	
<span class='corners-bottom'><span></span></span></div></div></div>
<div id='col3'><div id='col3_content' class='clearfix'>
<div id='content'><span class='corners-top'><span></span></span>

<h1 class='heading'>Error Code <?php echo $error_code; ?></h1>

<p><?php echo $explanation; ?><br><?php echo '&nbsp;&nbsp;' . $page_redirected_from; ?></p>
<p><?php echo $TTPDS_lng['error_back'] . ' '; ?><a href="http://<?php echo TTPDS_URL . "?" . $linkstr; ?>"><?php echo TTPDS_URL; ?>
</a></p>

<div class='hspacer'>&nbsp;</div><span class='corners-bottom'><span></span></span></div></div>
<div id='ie_clearing'> &#160; </div></div></div>
<div id='footer'><span class='corners-top'><span></span></span>
&copy; <?php echo date('Y'); ?> by <a href="http://<?php $cr = (strlen($TTPDS_extra_copyright) > 0 ? $TTPDS_extra_copyright : 
TTPDS_ROOT); echo $cr; ?>"><?php echo $cr; ?></a> &amp; <a href="https://github.com/kromuchi/tt-pds" target="_blank" title="tt-pds">tt-pds</a> &ndash; <?php echo("<a href='https://" . TTPDS_URL . "?" . $linkstr . "&t=disclaimer'>" . $TTPDS_lng['title_disclaimer'] . "</a>"); ?>
<span class='corners-bottom'><span></span></span></div>
<div class='hspacer'>&nbsp;</div>
</div></div>
</body>
</html>

<!-- tt-pds  //  https://github.com/kromuchi/tt-pds -->
