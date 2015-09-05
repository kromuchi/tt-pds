<?php
$page_redirected_from = $_SERVER['REQUEST_URI'];
define('PTG_URL',$_SERVER['HTTP_HOST'] );
define('PTG_DIR',$_SERVER['DOCUMENT_ROOT'] );

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

# Get error code
switch (getenv("REDIRECT_STATUS")) {

	# "403 - Forbidden"
	case 403:
	$error_code = "403 Forbidden";
	$explanation = $PTG_lng['error_403'];
	break;

	# "404 - Not Found"
	case 404:
	$error_code = "404 Not Found";
	$explanation = $PTG_lng['error_404'];
	break;
	
	# "500 - Internal Server Error" //default
	case 500:
	$error_code = "500 Internal Server Error";
	$explanation = $PTG_lng['error_500'];
	break;
	
	default:
	$error_code = "500 Internal Server Error";
	$explanation = $PTG_lng['error_500'];
}

$linkstr = "lang=" . $lang . "&acc=" . $acc;

# Send error header
header($_SERVER["SERVER_PROTOCOL"] . ' ' . $error_code);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $PTG_lng['xml-lang']; ?>" lang="<?php echo $PTG_lng['lang']; ?>">  
<head>
<title><?php echo $error_code; ?></title>
<link rel='stylesheet' type='text/css' href='<?php echo '/template/master.css'; ?>'/>
<meta http-equiv='Content-type' content='text/html; charset=utf-8' />
</head>
<body>
<div class='page_margins'><div class='page'>
<div id='main'><div id='col1'><div id='col1_content' class='clearfix'>
<div id='menubar'><span class='corners-top'><span></span></span>
	<?php /**************** MENU ****************/ ?>
	<p></p>
	<div class='caption'><?php echo $PTG_lng['title']; ?><div class="right">
	</div></div>
	<ul class='links'>
		<?php 
		echo("<li><a href=\"http://" . PTG_URL . "?" . $linkstr."&t=help\">" . $PTG_lng['title_home'] . "</a></li>
		<br />");
		?>
	</ul>
	
<span class='corners-bottom'><span></span></span></div></div></div>
<div id='col3'><div id='col3_content' class='clearfix'>
<div id='content'><span class='corners-top'><span></span></span>

<h1 class='heading'>Error Code <?php echo $error_code; ?></h1>

<p><?php echo $explanation; ?><br><?php echo '&nbsp;&nbsp;http://' . PTG_URL . $page_redirected_from; ?></p>
<p><?php echo $PTG_lng['error_back'] . ' '; ?><a href="http://<?php echo PTG_URL;?>"><?php echo PTG_URL;?></a></p>

<div class='hspacer'>&nbsp;</div><span class='corners-bottom'><span></span></span></div></div>
<div id='ie_clearing'> &#160; </div></div></div>
<div id='footer'><span class='corners-top'><span></span></span>
&copy; <?php echo date('Y'); ?> by <a href="http://<?php $cr = (strlen($PTG_extra_copyright) > 0 ? $PTG_extra_copyright : $PTG_lng['vfalkenhahn']); echo $cr;?>"><?php echo $cr;?></a> &ndash; <?php echo "<a href=\"http://" . PTG_URL . "?" . $linkstr."&t=disclaimer\">" . $PTG_lng['title_disclaimer'] . "</a>"; ?>
<span class='corners-bottom'><span></span></span></div>
<div class='hspacer'>&nbsp;</div>
</div></div>
</body>
</html>
