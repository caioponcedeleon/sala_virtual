<?php
include('conectar.php');

$mysql_infos = $mysqli->query("SELECT * FROM dados WHERE id_dado = '1'");
	$infinfo = $mysql_infos->fetch_array();
	
$passa		= array('estado' => $infinfo['momento_dado']);
		
		echo json_encode($passa);
?>