<?php
usleep(1000);
$data = $_SERVER;
function getIp()	{
	if(strlen($_SERVER["REMOTE_ADDR"]) > 4)	{
		return $_SERVER["REMOTE_ADDR"];
	}
	else if(strlen($_SERVER["HTTP_X_FORWARDED_FOR"]) > 4)	{
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	else	{
		return $_SERVER["HTTP_CLIENT_IP"];
	}
}
function ip_details($ip)	{
	$json = file_get_contents("http://ipinfo.io/" . $ip . "/geo");
	//$json = file_get_contents("http://ipinfo.io/" . $ip . "?token=" . file_get_contents(dirname(getcwd()) . "/private/" . "ipinfo_io_token.txt"));
	$details = json_decode($json, true);
	return $details;
}
$IP_ADDRESS = getIp();
date_default_timezone_set ("Etc/GMT-4");
$data = implode("\n", $data);
$data .= "\n\n" . gethostbyaddr($IP_ADDRESS);
$data .= "\n\n\n\n" . implode("\n", ip_details($IP_ADDRESS));
$t = time();
file_put_contents(dirname(getcwd()) . "/data" . $_SERVER["PHP_SELF"] . "/" . date("Y-m-d", $t) . " " . date("H-i-s", $t) . "_" . hrtime(1) . ".txt", $data);
?>