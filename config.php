<?php
require 'environment.php';

ini_set('display_errors', 'on');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "https://descomplicazap.com/owner/");
	$config['dbname'] = 'cardapio';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'desco633_descomplicaroot';
	$config['dbpass'] = 'root';
} else {
	define("BASE_URL", "http://localhost/psr/psr-4-mvc-api/");
	$config['dbname'] = 'mvc_psr4';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";charset=utf8;host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}