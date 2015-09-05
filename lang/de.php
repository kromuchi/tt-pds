<?php if(!defined('TTPDS_DIR')){ header("Location: http://".$_SERVER['HTTP_HOST']); exit; }

/** Deutsche Sprachdatei **/

$TTPDS_lng['xml-lang']			= 'de';
$TTPDS_lng['lang']				= 'de';
$TTPDS_lng['title']				= 'Photodownload';
$TTPDS_lng['title_home']			= 'Willkommen | Hilfe';
$TTPDS_lng['title_piclist']		= 'Photos:';
$TTPDS_lng['more_title']			= 'Links';
$TTPDS_lng['more_vfalkenhahn']	= 'Meine Photo-Homepage';
$TTPDS_lng['error_key']			= 'Dein Zugriffscode ist falsch. Du kannst keine Gallery sehen. Bitte wende dich an den zuständigen Administrator. Vielen Dank.';
$TTPDS_lng['error_files']			= 'Leider sind keine Dateien in dieser Gallery vorhanden. Bitte versuche es zu einem späteren Zeitpunkt nocheinmal. Vielen Dank.';
$TTPDS_lng['fatal']				= 'Fehler im System. Bitte wähle eine andere Gallery aus und benachrichtige den zuständigen Administrator über diesen Lapsus. Vielen Dank.';
$TTPDS_lng['nopass']				= 'Für diese Dateien gibt es kein Passwort.';
$TTPDS_lng['pass_hint']			= 'Das Passwort zum Entpacken der unten aufgelisteten Dateien lautet';
$TTPDS_lng['help_pre']			= 'Wenn du nicht weißt, was du mit den herunterladenen Dateien machen sollst, schau bitte in der';
$TTPDS_lng['help_lnk']			= 'Hilfe';
$TTPDS_lng['help_post']			= 'nach.';
$TTPDS_lng['title_disclaimer']	= 'Impressum';
$TTPDS_lng['disclaimer']			= 'Diese Seite ist nur für ausgewählte Personen und nicht für den öffentlichen Zugriff bestimmt und hat deshalb keinen eigenen Disclaimer.';
$TTPDS_lng['back']				= 'zurück';
$TTPDS_lng['long_help_text']		= '<p>Auf dieser Seite findest du die Downloadlinks für die Photos. Außerdem ist hier auch eine <b>ausführliche Anleitung für Jedermann</b>. Am Besten gehst du einfach <b>Schritt für Schritt</b> vor (wenn du keine Ahnung hast):</p>

	<h2>Photos herunterladen</h2>
	<p>Abhängig davon, wie dein Zugriffslink lautet, kannst du links auf verschiedene Rubriken zugreifen. Dort finden sich die Links für die Photoarchive, getrennt nach Photograf. Lade einfach die gewünschten Dateien (von einem Photografen musst du immer alle Dateien in das gleiche Verzeichnis runterladen, um die Photos entpacken zu können).</p>
	<p>Bitte beachte, dass die einzelnen Archivdateien bis zu 300mb groß sein können. Größere Archive sind auf mehrere Dateien verteilt, damit sie sich einfacher herunterladen lassen.</p>
	
	<h2>Photos entpacken</h2>
	<p>Hast du die gewünschten Dateien runtergeladen, musst du die Photos entpacken. Zur Sicherheit sind die Archive noch mit einem Passwort versehen, dass auch auf der Seite mit den Links steht.</p>
	<ul class="bord">
		<li><b>zip</b><br/>Zip-Dateien lassen sich auch mit Windows Bordmitteln entpacken. Einfach die Datei öffnen und den Inhalt in den gewünschten Zielordner kopieren. Natürlich kannst du auch das unter \'7z\' beschriebene Programm verwenden.</li>
		<li><b>7z, rar, 001, 002, ...</b><br/>Für 7z- oder 001-Dateien brauchst du ein Zusatzprogramm (das natürlich auch die gängigen Formate wie Zip entpacken kann). Hast du noch kein Programm zum entpacken (z.B. Winrar oder 7zip), so lade dir am Besten das kostenlose Programm <a href="http://www.7-zip.org/download.html" target="_blank">7zip</a> (Windows, Linux) herunter und installiere es. Bist du von der Homepage überfordert oder weist nicht, was du runterladen sollst, verwende diesen <a href="http://downloads.sourceforge.net/sevenzip/7z920.msi" target="_blank">Direktlink</a> (Windows 32bit). Bist du ein Mac-User, schau mal nach <a href="http://leifertin.info/app/eZ7z/" target="_blank">eZ7z</a>. Öffne nun eine .001-Datei (diesen Schritte musst du nun für alle Photografen (d.h. 001-Dateien) wiederholen) mit dem 7zip-File Manager (7zFM.exe oder Verknüpfung auf dem Desktop oder Startmenü) und gib das Passwort ein. Nun kannst du die darin enthaltenen Photos entpacken. <b>Die .00x-Dateien (mit x>1) musst du nicht mehr öffnen, beim Entpacken der .001-Dateien werden die mit den höheren Nummern automatisch auch entpackt.</b></li>
	
	<h2>Photos anzeigen</h2>
	<p>Die Photos sind so umbenannt, dass du alle Photos einer Gallerie in einen Ordner entpacken kannst. So sind die Photos automatisch chronologisch sortiert (wenn du sie dir nach Dateinamen sortiert anzeigen lässt). Dies ist z.B. geeignet für eine Diashow. Damit man immer noch sieht, von wem die Photos sind, steht der Name des Photografen am Ende des Dateinamens.</p>
	<p>Und nun viel Spaß beim herunterladen und ansehen. </p>';
	
$TTPDS_lng['admin_allcodes']		= 'Zugriffscodes';
<<<<<<< HEAD
=======
$TTPDS_lng['vfalkenhahn'] 		= 'vfalkenhahn.de';
$TTPDS_lng['error_403']			= 'Die angeforderte URL ist geschützt:';
$TTPDS_lng['error_404']			= 'Die angeforderte URL wurde nicht gefunden:';
$TTPDS_lng['error_500']			= 'Unerwarteter Serverfehler:';
$TTPDS_lng['error_back']			= 'Zurück zur Homepage:';
>>>>>>> htaccess

?>
