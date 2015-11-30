
<?php
$var = 'idea';
$url = 'http://finance.google.com/finance/info?client=ig&q=NSE%3a'.$var;
$url = 'http://d.yimg.com/autoc.finance.yahoo.com/autoc?query='.$var.'.ns&callback=YAHOO.Finance.SymbolSuggest.ssCallback';
$varq = "";
$output = @file_get_contents($url); 
$vfar = substr($output,84,strlen($output)-84);
$obj = json_decode($vfar);
$pieces = explode("\"", $vfar);
if(isset($pieces[6]))
{
	 echo $pieces[6]."  ".$pieces[2];
}
else
{
	echo "False";
}

?>