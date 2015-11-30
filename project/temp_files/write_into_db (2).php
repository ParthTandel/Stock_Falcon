<?php
require_once('mailsender.php');
require_once('config.php');
require_once('config.php');
require_once('database.php');

$test = new data_base();
$values1 = array('stock_ticker','stock_name');
$table = 'prediction';
$input1 = array('ACC' , 'ACC Ltd.');


$file = fopen("temp.txt","r");
$file2 = fopen("temp2.txt","r");

while(!feof($file) && !feof($file2))
  {
  	$val = fgets($file) ;
  	$val2 = fgets($file2) ;
 	$input1 = array($val , $val2) ;
 


  $values2 = implode(",", $values1);

 $input2 = implode ("', '", $input1);
  $test->insert($values2 , $table , $input2);
  }
fclose($file);



?>