<?php
require 'environment.php';

define("BASE", "http://127.0.0.1/facebook/");

global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'facebook';
	$config['host'] = '127.0.0.1';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
} else {
	$config['dbname'] = 'facebook';
	$config['host'] = '127.0.0.1';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}
?>