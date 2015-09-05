<?php if(!defined('PTG_DIR')){ header("Location: http://".$_SERVER['HTTP_HOST']); exit; }

#   M A I N   S E T T I N G S

# Insert master key here to call admin interface using ?admin=getallaccesscodes&mkey=somerandombutcomplexmasterkey
$PTG_masterkey 		= "somerandombutcomplexmasterkey";

# Truncates the $_GET["acc"] variable to prevent random attacs
$PTG_keys_maxlen 	= 50;

# Datafolder without trailing '/'
$PTG_datafolder		= "data";

# Extra copyright domain (if blank, root domain is used)
$PTG_extra_copyright = "vfalkenhahn.de";

# Available languages (uncomment 
$PTG_langs = array(
        'en', //default
        'de',
);

?>