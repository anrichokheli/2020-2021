<?php
require dirname(getcwd()) . "/private/" . "security.php";
date_default_timezone_set ("Etc/GMT-4");
if(time() > strtotime("2020-12-31 23:59:0"))	{
	exit("0000");
}
$input = $_GET["num"];
$input = filter_var($input, FILTER_VALIDATE_INT);
if($input === false)	{
	exit("0000");
}
$input = substr(abs($input), 0, 10);
require file_get_contents(dirname(getcwd()) . "/private/" . "URL.txt") . "get_number?num=" . $input;
?>