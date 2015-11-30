
<?php
$var = "ACC";
$url = 'http://finance.google.com/finance/info?client=ig&q=NSE%3a'.$var;
$varq = "";
$output = @file_get_contents($url); 
$vfar = substr($output,6,(strlen($output)-8));
$obj = json_decode($vfar);
echo $vfar."<br>";
var_dump(json_decode($vfar));
echo $obj->{"t"};

?>