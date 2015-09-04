<?php if(!defined('PTG_DIR')){ header("Location: http://".$_SERVER['HTTP_HOST']); exit; }

/** Englische Sprachdatei **/

$PTG_lng['xml-lang']			= 'en';
$PTG_lng['lang']				= 'en';
$PTG_lng['title']				= 'picturedownload';
$PTG_lng['title_home']			= 'Welcome | Help';
$PTG_lng['title_piclist']		= 'Pictures:';
$PTG_lng['more_title']			= 'Links';
$PTG_lng['more_vfalkenhahn']	= 'My photos';
$PTG_lng['error_key']			= 'As your accesscode is wrong, you\'re not allowed to see any galleries. Please contact your administrator. Thank you.';
$PTG_lng['error_files']			= 'At the moment there are no files in this gallery. Please come back later for downloading the pictures. Thank you for your patience.';
$PTG_lng['fatal']				= 'System error. Please select another gallery and inform the administator about this error. Thank you.';
$PTG_lng['nopass']				= 'There is no passwort set.';
$PTG_lng['pass_hint']			= 'The password for extracting the listed files is ';
$PTG_lng['help_pre']			= 'If you don\'t know how to proceed after downloading the files, please have a look at the ';
$PTG_lng['help_lnk']			= 'help';
$PTG_lng['help_post']			= 'section.';
$PTG_lng['title_disclaimer']	= 'Disclaimer';
$PTG_lng['disclaimer']			= 'This webpage is only for selected privat use and not for public and hence has noch public disclaimer.';
$PTG_lng['back']				= 'back';
$PTG_lng['long_help_text']		= '<p>On this page you can find the download links for the photos. In addition, there is also a detailed guide for everyone. At best you just go step by step:</p>

	<h2>Downloading files</h2>
	<p>Depending on your access link, you have access to various sections. There you will find the links for the photo archives. Just load the desired files. <b>If the archives are named like *.001, *.002, you always have to download all files with the same suffix in order to extract them properly.</b></p>
	<p>Please note that the individual archive files can be up to 300mb. Larger archives are divided into several files so that they can be downloaded easily.</p>
	
	<h2>Extract photos</h2>
	<p>After having downloaded all the files you want, you can unzip the photos. For safety, most of the archives are protected by a password. <b>You will find this password on the same page</b> where you see the links.</p>
	<ul class="bord">
		<li><b>zip</b><br/>Zip files can be unzipped with standard tools. Simply open the file and copy its contents to the desired destination folder. Of course you can also use the \'7z\'-program (described below).</li>
		<li><b>7z, rar, 001, 002, ...</b><br/>
			In order to extract 001-, rar- or 7z-files you need an additional program (which can of course also unpack the popular formats such as Zip). If you don\'t have a program to unzip those files (eg Winrar or 7zip), then download the freeware tool <a href="http://www.7-zip.org/download.html" target="_blank">7zip</a> (Windows, Linux) and install it. In case you have no idea, what do download on the 7zip-Homepage, simply use this <a href="http://downloads.sourceforge.net/sevenzip/7z920.exe" target="_blank">direct link</a> (Windows 32). If you are a Mac user, have a look at <a href="http://leifertin.info/app/eZ7z/" target="_blank">eZ7z</a>. Now open the 7z, rar or .001 file with the 7zip File Manager (7zFM.exe or shortcut on the desktop or Start menu) and enter the password. Now you can unzip the photos contained therein. <b>Don\'t open the .00x-files (with x>1) as the containing files are automatically extracted when unpacking the 001-files.</b></li>
	
	<h2>View photos</h2>
	<p>The photos are named such that you can unpack all photos in one single gallery folder. The photos are automatically sorted chronologically (if you view them sorted by file name). This is for example suitable for a slideshow. You can always see who took the photographs by having a look at the filename where the name of the photographer is shown in brackets at the end of the filename.</p>
	<p>And now enjoy watching the pictures.</p>';
	
$PTG_lng['admin_allcodes']		= 'Access codes';
$PTG_lng['vfalkenhahn']			= 'vfalkenhahn.de';
$PTG_lng['error_403']			= 'The URL you requested is protected:';
$PTG_lng['error_404']			= 'The URL you requested is not found:';
$PTG_lng['error_500']			= 'The server experienced an unexpected error:';
$PTG_lng['error_back']			= 'Go back to the main homepage:';

?>
