<?php

	$handle = fopen("downland_list_data.txt",'a+');
	$ret = fwrite($handle,"七龙珠".PHP_EOL);
	if(!$ret){
		echo $data."write fail!";
	}	
	fclose($handle);	
	$episode = 5;
	while($episode <= 153){
		$address_number = $episode -1;
		$url = "https://www.guaguo.cc/a/122065-0-".strval($address_number).".html";    //第5集的地址
		$pattern = "/<script>.*.<\/script>/";
		$result = [];
		$content = file_get_contents($url);
		$ret = preg_match_all($pattern,$content,$result);
		//echo $content.PHP_EOL;
		//print_r($result);
		$key_script = $result[0][2];
		$temp1 = strstr($key_script,'now="');
		$temp2 = strstr($temp1,';',true);
		//echo PHP_EOL.$temp2;
		$temp3 = strstr($temp2,'h');
		$key_info = strstr($temp3,'"',true);
		//echo PHP_EOL.$key_info;
		$data = "第".$episode."集地址: ".$key_info.PHP_EOL;	
		$handle = fopen("downland_list_data.txt",'a+');
		$ret = fwrite($handle,$data);
		if(!$ret){
			echo $data."write fail!";
		}	
		fclose($handle);	
		echo "finish ".strval($episode)." address write: ".$data.PHP_EOL;
		$episode++;
	}

?>
