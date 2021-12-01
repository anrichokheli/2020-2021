<?php
require dirname(getcwd()) . "/private/" . "timeCheck.php";
sleep(1);
function isProxy()	{
	$ports = array(8080,80,81,1080,6588,8000,3128,553,554,4480);
	foreach($ports as $port) {
		if (@fsockopen($GLOBALS["user_ip"], $port, $errno, $errstr, 1)) {
			return 1;
		}
	}
	return 0;
}
function exitFunction()	{
	if(!defined("DO_NOT_EXIT"))	{
		exit("0000");
	}
	else if(!defined("0000"))	{
		define("0000", "");
	}
}
$user_ip = getIp();
$user_ip = filter_var($user_ip, FILTER_VALIDATE_IP);
$user_ip = filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE);
$user_ip = filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE);
if($user_ip === false)	{
	exitFunction();
}
$externalContent = file_get_contents('http://checkip.dyndns.com/');
preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
$externalIp = $m[1];
if(isProxy() && ($user_ip != $externalIp))	{
	exitFunction();
}
$dirPath = dirname(getcwd()) . "/ip/";
$fileName = $dirPath . $user_ip . ".txt";
if(!file_exists($fileName))	{
	if(!defined("DO_NOT_COUNT"))	{
		file_put_contents($fileName, "1");
	}
}
else	{
	$countVisits = file_get_contents($fileName);
	$countVisits = intval($countVisits);
	$countVisits += 1;
	if($countVisits > 10)	{
		exitFunction();
	}
	if(!defined("DO_NOT_COUNT"))	{
		$countVisits = strval($countVisits);
		file_put_contents($fileName, $countVisits);
	}
}
//echo "1111";
?>