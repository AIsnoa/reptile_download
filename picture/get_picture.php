<?php
	$file_content = file_get_contents("download_list.txt");
	$trimmed = rtrim($file_content,PHP_EOL);
	$arr = explode(PHP_EOL,$trimmed);
	foreach($arr as $value){
		$shell_str = "wget ".$value;
		$output = shell_exec($shell_str);
	}
?>
