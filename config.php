<?php if(!defined('TTPDS_DIR')){ header("Location: http://".$_SERVER['HTTP_HOST']); exit; }

#   M A I N   S E T T I N G S

# Insert master key here to call admin interface using ?admin=getallaccesscodes&mkey=somerandombutcomplexmasterkey
$TTPDS_masterkey 		= "somerandombutcomplexmasterkey";

# Truncates the $_GET["acc"] variable to prevent random attacks (if not exists, the length of all access keys in data/data.php +10% is taken as limit.
# $TTPDS_keys_maxlen 	= 50;

# Datafolder without trailing '/'
$TTPDS_datafolder		= "data";

# Extra copyright domain (if blank, root domain is used)
$TTPDS_extra_copyright = "vfalkenhahn.de";

# Available languages (uncomment to disable)
$TTPDS_langs = array(
        'en', //default
        'de',
);

?>
