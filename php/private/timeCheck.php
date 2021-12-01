<?php
require_once dirname(getcwd()) . "/private/" . "data.php";
date_default_timezone_set ("Etc/GMT-4");
$start_datetime = "2020-12-31 23:0:0";
$end_datetime = "2020-12-31 23:59:45";
$start_unix = strtotime($start_datetime);
$t = time();
$javascript = "
<script>
var unix = " . $t . ";
function getDateTime(){var t = new Date(unix * 1000); document.getElementById(\"datetime\").innerHTML = (t.getHours() + ':' + t.getMinutes() + ':' + t.getSeconds() + \" \" + t.getFullYear() + '-' + (t.getMonth() + 1) + '-' + t.getDate());}
getDateTime();
setInterval(function(){unix += 1; getDateTime(); if(unix == " . $start_unix . "){alert(\"კავშირი დაიწყო! ვებ გვერდის გასახსნელად, დააჭირეთ განახლებას (reload 🔄)\")}}, 1000);
</script>
";
$webCode1 = "<center>";
$webCode2 = "<br><br>მიმდინარე დრო: <span id=\"datetime\"></span></center>" . $javascript;
if($t < $start_unix)	{
	exit($webCode1 . "კავშირი დაიწყება " . $start_datetime . " - ზე" . $webCode2);
}
else if($t >= strtotime($end_datetime))	{
	exit($webCode1 . "კავშირი დასრულდა " . $end_datetime . " - ზე" . $webCode2);
}
?>