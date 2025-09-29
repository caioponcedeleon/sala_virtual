<?php
$text = explode('|','primeiro|segundo|terceiro');

$numero = count($text);

$a = 0;
foreach($text as $texti){
	$a++;
	if($a != $numero){
		echo $texti . ' (---) ';
	}else{
		echo $texti;
	}
}
?>