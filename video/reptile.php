<?php
	$handle = fopen("download_list.txt",'a+');
	$ret = fwrite($handle,"七龙珠".PHP_EOL);
	if(!$ret){
		echo $data."write fail!";
	}	
	$episode = 1;
	
	while($episode <= 153){
		$time1 = microtime(true);

		$address_number = $episode -1;
		$url = "https://www.guaguo.cc/a/122065-0-".strval($address_number).".html";    //第1集的地址
		$pattern = "/<script>.*.<\/script>/";
		$result = [];
		$curl_shell = "curl ".$url;	
		//$content = file_get_contents($url);
		$content = shell_exec($curl_shell);	
		$ret = preg_match_all($pattern,$content,$result);


		//echo $content.PHP_EOL;
		print_r($result);
		$key_script = $result[0][2];
		$temp1 = strstr($key_script,'now="');
		
		$temp2 = strstr($temp1,';',true);
		//echo PHP_EOL.$temp2;
	
		$temp3 = strstr($temp2,'h');
	
		$key_info = strstr($temp3,'"',true);
		//echo PHP_EOL.$key_info;	
		
		$data = "第".$episode."集地址: ".$key_info.PHP_EOL;	
		$ret = fwrite($handle,$data);
		if(!$ret){
		echo $data."write fail!";
		}	
		echo "finish ".$data.PHP_EOL;
		$episode++;
		
		$time2 = microtime(true);
                $use_time = $time2-$time1;
                $use_time = round($use_time,3);
                echo "Finish analysis.".' use time:'.strval($use_time).'s.'.PHP_EOL;
	}
		fclose($handle);	

?>
