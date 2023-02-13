<?php
	$file_content = file_get_contents("download_list.txt");
	//echo $file_content;
	$trimmed = rtrim($file_content);    //去掉最后面的/n
	//echo $trimmed;
	$arr = explode(PHP_EOL,$trimmed);
	//print_r($arr);
	array_shift($arr);
	foreach($arr as $value){
		$temp1 = strstr($value,':',true);	//基本信息获取
		//echo $temp1;
		$temp2 = strstr($value,'h');		//下载地址获取	
		$temp3 = mb_strstr($temp1,'集',true,'UTF-8');
		$episode = mb_substr($temp3,1,NULL,'UTF-8');
		$file_name = "Dargon_Ball_" . $episode;  //文件名
		//下载控制模块	
		if(intval($episode)<=31){
			continue;
		}
		if(intval($episode)>35){
			break;
		}
		echo "正在下载:". $episode."集".PHP_EOL;
	

		$url = " ".$temp2." ";		

		$start_time = explode(' ',microtime());
		
		//用ffmpeg下载的指令。
		//$download_str1 = "ffmpeg -i" . $url . "-c copy -bsf:a aac_adtstoasc" ." video/". $file_name . ".mp4"; 
		
		#用go可执行程序下载的指令。
		$go_download_pwd = "/home/lianjie/test/mygithub/reptile_download/bin/m3u8d";
		$content_save_pwd = "/home/lianjie/test/mygithub/reptile_download/video/";
		$download_str2 = "/".$go_download_pwd." download -u".$url."-d ".$content_save_pwd.$file_name;
		//echo $download_str2;
		$output = shell_exec($download_str2);
		$mv_str = "mv ".$content_save_pwd.$file_name."/index.mp4 ".$content_save_pwd.$file_name.".mp4";
		//echo $mv_str.PHP_EOL;
		$mv_output = shell_exec($mv_str);
		$delete_str = "rm -rf ".$content_save_pwd.$file_name;
		//echo $delete_str.PHP_EOL;
		$delete_output = shell_exec($delete_str);

		$end_time = explode(' ',microtime());
		$use_time = $end_time[0]+$end_time[1]-($start_time[0]+$start_time[1]);
		$use_time = round($use_time,3);
		echo "Finish ".$file_name.' use time:'.strval($use_time).' s.'.PHP_EOL;
	}

?>
