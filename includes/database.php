<?php
try{
	$pdo = new PDO('mysql:host=localhost;dbname=supJeans', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}catch(Exception $e){
	die("Unable to connect to the database");
}