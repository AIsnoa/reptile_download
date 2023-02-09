<?php
	$url = "https://music.163.com/#/song?id=1897100445";
	$html = file_get_contents($url);
	echo $html.PHP_EOL;
?>
