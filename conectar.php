<?php

$URL_GERAL = 'http://localhost/sala_virtual/';

$mysqli = new mysqli('localhost:3306','root','','sala_virtual');

if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

?>