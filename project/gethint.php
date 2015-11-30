<?php


require_once('config.php');
require_once('database.php');


$test = new data_base();

$sql = "SELECT stock_ticker FROM stockfalcon.prediction";   
$result = mysql_query($sql);
$a= array();


while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{
     $a[] = $row["stock_ticker"];
}

$q = $_REQUEST["q"];

$hint = "";


if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

echo $hint === "" ? "no suggestion" : $hint;
  
?>