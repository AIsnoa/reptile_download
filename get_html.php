<?php
	$url = "https://www.guaguo.cc/a/122065-0-0.html";
//	$html = file_get_contents($url); //http
	$curl_shell = "curl ".$url;
	$data = shell_exec($curl_shell);
?>
