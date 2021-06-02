<?php
session_start();
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

// Define constants
define('HOSTNAME', "localhost");
define('USERNAME', "root");
define('PASSWORD', "");
define('DBNAME', "whatsbot");

define('APP_NAME', 'WhatsBot');
define('APP_SESSION_ID', 'FSBwa64ebo554ts21');
define('APP_PATH', 'http://localhost/whatsbot');

define('COPYRIGHT', 'WhatsBot, tous droits réservé au FSBM');

// Global vars
$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);
$context_path = '';

// includes
require_once 'functions.php';
require_once 'routes.php';