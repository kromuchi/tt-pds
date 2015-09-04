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

# Send error header
header($_SERVER["SERVER_PROTOCOL"] . ' ' . $error_code);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $PTG_lng['xml-lang']; ?>" lang="<?php echo $PTG_lng['lang']; ?>">  
<head>
<title><?php echo $error_code; ?></title>
<meta http-equiv='Content-type' content='text/html; charset=utf-8' />
</head>
<body>

<h1>Error Code <?php echo $error_code; ?></h1>

<p><?php echo $explanation; ?><br><?php echo '&nbsp;&nbsp;' . PTG_URL . $page_redirected_from; ?></p>
<p><?php echo $PTG_lng['error_back'] . ' '; ?><a href="http://<?php echo PTG_URL;?>"><?php echo PTG_URL;?></a></p>

</body>
</html>