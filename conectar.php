<?php

$URL_GERAL = 'http://localhost/sala_virtual/';

$mysqli = new mysqli('localhost','db_username','db_password','sala_virtual');

if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

?>