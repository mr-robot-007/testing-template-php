<?php
ob_start();
session_start();
define("SERVER_NAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DB", "testDB");

$root = dirname(__FILE__).'/../';
// echo $root;
// C:\xampp\htdocs\testing-template\config

define("ROOT_PATH",$root);
include ROOT_PATH.'includes/functions.php';