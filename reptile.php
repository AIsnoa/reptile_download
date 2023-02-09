<?php
	
	$handle = fopen("download_list.txt",'a+');
	$url = "https://view.inews.qq.com/a/20211112A0E8L100";
	$html = file_get_contents($url);
	//echo $html . PHP_EOL;
	$pattern = "/\"IMG_.*?}/";
	$result = [];
	$ret = preg_match_all($pattern,$html,$result);
	//print_r($result);
	foreach($result[0] as $value){
		$key = "\"url\":\"";
		$temp1 = strstr($value,$key);
		//echo $temp1.PHP_EOL;
		$temp2 = strstr($temp1,",",true);
		//echo  $temp2.PHP_EOL;
		$temp3 = strstr($temp2,"h");
		//echo $temp3.PHP_EOL;
		$temp4 = rtrim($temp3,"\"");	
		echo $temp4.PHP_EOL;
		$data = $temp4.PHP_EOL;
		$ret = fwrite($handle,$data);		
		if(!$ret){
			echo "write fail:".$data;
		}	
	}

	fclose($handle);

?>
