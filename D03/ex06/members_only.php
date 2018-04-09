<?php
if ($_SERVER['PHP_AUTH_USER'] == "zaz" && $_SERVER['PHP_AUTH_PW'] == "jaimelespetitsponeys")
{
	header("Content-type: image/png");
	$img = '../img/42.png';
	$data = file_get_contents($img);
	$base64 = 'data:image/png;base64,' . base64_encode($data);
	echo "<html><body>\n";
	echo "Bonjour Zaz<br />\n";
	echo "<img src='$base64;'>\n";
	echo "</body></html>"."\n";
}
else
{
	header("WWW-Authenticate: Basic realm=''Espace membres''");
	header('HTTP/1.0 401 Unauthorized');
	echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>"."\n";
}
?>