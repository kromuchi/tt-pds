<?php if(!defined('TTPDS_DIR')){ header("Location: http://".$_SERVER['HTTP_HOST']); exit; }

$TTPDS_galleries = array(

	/* // E X S A M P L E   S T R U C T U R E

	"id" => array(			// Random ID (sorting criteria)
		"key" => "", 		// Access-Code that is used via ?acc=complexsamplekey or ?acc=complexsamplekeyanotherkeyandrandomchars, where multiple keys can be attached
		"access" => "0",
		"title" => "", 		// Title
		"folder" => "", 	// Subfolder where archives are places
		"pass" => "", 		// Passwort for archives in subdirectory (may be empty)
	),
	
	*/
	
	// F O L D E R   D A T A   ( E X A M P L E )

	"id1" => array(
		"key" => "complexsamplekey", 		
		"access" => "0",
		"title" => "Christmas 2015", 			
		"folder" => "exampledir1", 		
		"pass" => "", 					// no pass
	),
	
	"id2" => array(
		"key" => "anotherkey",
		"access" => "0",
		"title" => "Holidays", 			// Titel
		"folder" => "exampledir2", 		// Unterordnuer
		"pass" => "testpass", 			// Passwort for archives in subdirectory
	),

);

?>